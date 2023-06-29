const urlParams = new URLSearchParams(window.location.search);
const nickname = urlParams.get("nickname");
const base_url = document.body.dataset.baseurl;

const blogsDiv = document.querySelector(".blogs");
const currentUserId = localStorage.getItem("user_id");

function getBlogs() {
  axios
    .get(`${base_url}/api/blogs/list.php?nickname=${nickname}`)
    .then((res) => {
      showBlogs(res.data);
    });
}

function showBlogs(blogs) {
  console.log(blogs);
  let blogsHtml = ``;
  if (blogs.length == 0) blogsDiv.innerHTML = "<h2>0 blogs</h2>";
  for (let i = 0; i < blogs.length; i++) {
    let dropdown = ``;
    if (currentUserId == blogs[i].user_id) {
      dropdown += `
      <span class="link">
        <img src="images/dots.svg" alt="">
        Еще

        <ul class="dropdown">
          <li> <a href="${base_url}/editblog.php?id=${blogs[i].id}">Редактировать</a> </li>
          <li><a href="" class="danger" onclick = "deleteBlog(${blogs[i].id})">Удалить</a></li>
        </ul>
      </span>
      `;
    }
    blogsHtml += `
    <div class="blog-item">
      <img class="blog-item--img" src="${blogs[i].image}" alt="">
      <div class="blog-header">
        <h3>${blogs[i].title}</h3>
        ${dropdown}

      </div>
      <p class="blog-desc">
         ${blogs[i].description}
      </p>
      <p class="blog-desc">
         ${blogs[i].name}
      </p>

      <div class="blog-info">
        <span class="link">
          <img src="images/date.svg" alt="">
          22.12.21
        </span>
        <span class="link">
          <img src="images/visibility.svg" alt="">
          21
        </span>
        <a class="link">
          <img src="images/message.svg" alt="">
          4
        </a>
        <span class="link">
          <img src="images/forums.svg" alt="">
          3
        </span>
        <a class="link">
          <img src="images/person.svg" alt="">
          ${blogs[i].nickname}
        </a>
      </div>
    </div>
    `;
  }
  if (blogs.length > 0) blogsDiv.innerHTML = blogsHtml;
}

getBlogs();

function deleteBlog(id) {
  axios.get(`${base_url}/api/blogs/delete.php?id=${id}`).then(getBlogs());
}