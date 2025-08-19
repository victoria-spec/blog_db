<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Post List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-card-list me-2" viewBox="0 0 16 16">
        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
        <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
      </svg>
      MyBlog
    </a>
  </div>
</nav>

<!-- Posts Container -->
<div class="container mt-4">
  <h2 class="mb-4">Posts</h2>
  <div id="postContainer" class="row g-4">
    <!-- Cards will be inserted dynamically -->
  </div>
</div>

<!-- Modal to show full post -->
<div class="modal fade" id="viewPostModal" tabindex="-1" aria-labelledby="viewPostModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewPostTitle"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="viewPostContent">
        <!-- Full content will go here -->
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script>
  fetch('db/index.php')
    .then(response => response.json())
    .then(posts => {
      const postContainer = document.getElementById("postContainer");
      postContainer.innerHTML = ''; // Clear old content

      posts.forEach(post => {
        const card = document.createElement("div");
        card.className = "col-md-4";

        card.innerHTML = `
          <div class="card h-100 shadow-sm">
            <div class="card-body">
              <h5 class="card-title">${post.title}</h5>
              <p class="card-text">${post.summary}</p>
              <button class="btn btn-primary" onclick='viewPost(${JSON.stringify(post)})'>View</button>
            </div>
          </div>
        `;

        postContainer.appendChild(card);
      });
    })
    .catch(err => {
      console.error('Failed to fetch posts:', err);
      document.getElementById("postContainer").innerHTML = `<p class="text-danger">Failed to load posts.</p>`;
    });

  function viewPost(post) {
    document.getElementById("viewPostTitle").textContent = post.title;
    document.getElementById("viewPostContent").textContent = post.content;

    const modal = new bootstrap.Modal(document.getElementById("viewPostModal"));
    modal.show();
  }
</script>

</body>
</html>
