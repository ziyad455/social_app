<?php
session_start();



require "../../../app/database/conectdb.php";


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add New Post</title>
  <link rel="stylesheet" href="style.css">
</head>
<style>
  body {
    background-color: #f0f2f5;
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
  }

  .post-form-container {
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    width: 450px;
    text-align: center;
  }

  .post-form h2 {
    margin-bottom: 20px;
    color: #333;
  }

  .post-form label {
    display: block;
    text-align: left;
    margin-top: 15px;
    margin-bottom: 5px;
    font-weight: bold;
    color: #555;
  }

  .post-form textarea,
  .post-form input[type="file"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
  }

  .image-preview {
    margin-top: 15px;
    border: 2px dashed #ccc;
    padding: 10px;
    border-radius: 10px;
    text-align: center;
    min-height: 150px;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    position: relative;
  }

  .image-preview img {
    max-width: 100%;
    max-height: 200px;
    border-radius: 8px;
    object-fit: contain;
  }

  .image-preview span {
    color: #777;
  }

  .post-form button {
    margin-top: 20px;
    width: 100%;
    padding: 12px;
    background-color: #1877f2;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s;
  }

  .post-form button:hover {
    background-color: #155cc0;
  }

  .remove-image {
    position: absolute;
    top: 5px;
    right: 5px;
    background: rgba(0,0,0,0.5);
    color: white;
    border: none;
    border-radius: 50%;
    width: 25px;
    height: 25px;
    cursor: pointer;
    display: none;
  }
</style>
<body>
  <div class="post-form-container">
    <h2>Add New Post</h2>
    <form class="post-form">
      <label for="description">Description:</label>
      <textarea id="description" name="description" rows="4" placeholder="Write something..."></textarea>

      <label for="image">Select Image:</label>
      <input type="file" id="image" name="image" accept="image/*">

      <div class="image-preview" id="imagePreview">
        <span>No image selected</span>
        <button class="remove-image" id="removeImage">×</button>
      </div>

      <button type="submit">Post</button>
    </form>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const imageInput = document.getElementById('image');
      const imagePreview = document.getElementById('imagePreview');
      const removeImageBtn = document.getElementById('removeImage');
      const defaultText = imagePreview.querySelector('span');

      imageInput.addEventListener('change', function() {
        const file = this.files[0];
        
        if (file) {
          const reader = new FileReader();

          reader.onload = function(e) {
            defaultText.style.display = 'none';
            removeImageBtn.style.display = 'block';
            
            let img = imagePreview.querySelector('img');
            if (!img) {
              img = document.createElement('img');
              imagePreview.appendChild(img);
            }
            
            img.src = e.target.result;
          };

          reader.readAsDataURL(file);
        } else {
          defaultText.style.display = 'block';
          removeImageBtn.style.display = 'none';
          const img = imagePreview.querySelector('img');
          if (img) img.remove();
        }
      });

      removeImageBtn.addEventListener('click', function(e) {
        e.preventDefault();
        imageInput.value = '';
        defaultText.style.display = 'block';
        removeImageBtn.style.display = 'none';
        const img = imagePreview.querySelector('img');
        if (img) img.remove();
      });
    });
  </script>
</body>
</html>