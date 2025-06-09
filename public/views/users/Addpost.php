<?php
// session_start();
// var_dump($_SESSION);
// die();
session_start();
require "../../../app/database/conectdb.php";
$query1 = 'SELECT * FROM users WHERE id = ?';
$user = $db->selectOne($query1,[$_SESSION['id']]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create New Post</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    :root {
      --primary: #1877f2;
      --primary-hover: #166fe5;
      --secondary: #e4e6eb;
      --text-primary: #050505;
      --text-secondary: #65676b;
      --background: #f0f2f5;
      --card-bg: #ffffff;
      --border: #dddfe2;
      --error: #f02849;
    }
    
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }
    
    body {
      background-color: var(--background);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
    }
    
    .post-creation-card {
      background: var(--card-bg);
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      width: 100%;
      max-width: 500px;
      overflow: hidden;
      transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    
    .post-creation-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 24px rgba(0, 0, 0, 0.12);
    }
    
    .card-header {
      padding: 20px;
      border-bottom: 1px solid var(--border);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .card-title {
      font-size: 20px;
      font-weight: 700;
      color: var(--text-primary);
    }
    
    .close-btn {
      background: none;
      border: none;
      font-size: 20px;
      color: var(--text-secondary);
      cursor: pointer;
      transition: color 0.2s;
    }
    
    .close-btn:hover {
      color: var(--text-primary);
    }
    
    .post-form {
      padding: 20px;
    }
    
    .user-info {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
    }
    
    .user-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 12px;
      border: 1px solid var(--border);
    }
    
    .user-name {
      font-weight: 600;
      color: var(--text-primary);
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    .post-textarea {
      width: 100%;
      min-height: 120px;
      padding: 12px;
      border: 1px solid var(--border);
      border-radius: 8px;
      font-size: 15px;
      resize: none;
      outline: none;
      transition: border-color 0.3s, box-shadow 0.3s;
    }
    
    .post-textarea:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 2px rgba(24, 119, 242, 0.2);
    }
    
    .post-textarea::placeholder {
      color: var(--text-secondary);
      opacity: 0.7;
    }
    
    .image-upload-container {
      border: 2px dashed var(--border);
      border-radius: 8px;
      padding: 20px;
      text-align: center;
      cursor: pointer;
      transition: border-color 0.3s, background 0.3s;
      margin-bottom: 20px;
    }
    
    .image-upload-container:hover {
      border-color: var(--primary);
      background: rgba(24, 119, 242, 0.05);
    }
    
    .image-upload-container.active {
      border-color: var(--primary);
      background: rgba(24, 119, 242, 0.05);
    }
    
    .upload-icon {
      font-size: 40px;
      color: var(--primary);
      margin-bottom: 10px;
    }
    
    .upload-text {
      color: var(--text-primary);
      font-weight: 500;
      margin-bottom: 5px;
    }
    
    .upload-subtext {
      color: var(--text-secondary);
      font-size: 13px;
    }
    
    .file-input {
      display: none;
    }
    
    .image-preview-container {
      position: relative;
      margin-bottom: 20px;
      display: none;
    }
    
    .preview-image {
      width: 100%;
      max-height: 300px;
      object-fit: contain;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    
    .remove-image-btn {
      position: absolute;
      top: 10px;
      right: 10px;
      background: var(--error);
      color: white;
      border: none;
      width: 30px;
      height: 30px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: background 0.2s;
    }
    
    .remove-image-btn:hover {
      background: #d42d3d;
    }
    
    .form-actions {
      display: flex;
      justify-content: flex-end;
    }
    
    .submit-btn {
      background-color: var(--primary);
      color: white;
      border: none;
      border-radius: 6px;
      padding: 12px 24px;
      font-size: 15px;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.3s;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    
    .submit-btn:hover {
      background-color: var(--primary-hover);
    }
    
    .submit-btn:disabled {
      background-color: var(--secondary);
      cursor: not-allowed;
    }
    
    .character-counter {
      text-align: right;
      font-size: 13px;
      color: var(--text-secondary);
      margin-top: 5px;
      margin-bottom: 25px;

    }
    
    .error-message {
      color: var(--error);
      font-size: 13px;
      margin-top: 5px;
      display: none;
    }

    .color-picker-container {
      display: flex;
      gap: 8px;
      margin-bottom: 15px;
      padding: 5px;
    }
    
    .color-option {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      cursor: pointer;
      transition: transform 0.2s;
    }
    
    .color-option:hover {
      transform: scale(1.1);
    }
    
    .color-option.selected {
      border: 2px solid #333;
      box-shadow: 0 0 5px rgba(0,0,0,0.3);
    }
    
    @media (max-width: 480px) {
      .post-creation-card {
        border-radius: 0;
      }
      
      body {
        padding: 0;
        align-items: flex-start;
      }
    }
  </style>
</head>
<body>
  <div class="post-creation-card">
    <div class="card-header">
      <h2 class="card-title">Create Post</h2>
      <button class="close-btn">&times;</button>
    </div>
    
    <form action="../../../app/brain/user/post.php" class="post-form" method="POST" enctype="multipart/form-data">
      <div class="user-info">
        <img src="../../../public/assist/profiles/<?= htmlspecialchars($user['profile_picture']) ?>" class="user-avatar" />
        <span class="user-name"><?php echo $user["username"] ?></span>        
        
      </div>
      
      <div class="form-group">
        <textarea class="post-textarea" id="description" name="description" placeholder="What's on your mind?" maxlength="500"></textarea>
        <div class="character-counter"><span id="charCount">0</span>/500</div>
      </div>
      
      <!-- Color Picker Section -->
      <div class="color-picker-container">
          <div name="#fefefe" class="color-option" data-color="l#fefefe" style="background-color: #fefefe; border: 1px solid #ccc;"></div>
          <div name="#d6dce5" class="color-option" data-color="l#d6dce5" style="background-color: #d6dce5;"></div>
          <div name="#b3cde0" class="color-option" data-color="l#b3cde0" style="background-color: #b3cde0;"></div>
          <div name="#a2d4ab" class="color-option" data-color="l#a2d4ab" style="background-color: #a2d4ab;"></div>
          <div name="#ffccbc" class="color-option" data-color="l#ffccbc" style="background-color: #ffccbc;"></div>
          <div name="#f4a261" class="color-option" data-color="l#f4a261" style="background-color: #f4a261;"></div>
          <div name="#e76f51" class="color-option" data-color="d#e76f51" style="background-color: #e76f51;"></div>
          <div name="#6d6875" class="color-option" data-color="d#6d6875" style="background-color: #6d6875;"></div>
          <div name="#4a4e69" class="color-option" data-color="d#4a4e69" style="background-color: #4a4e69;"></div>
          <div name="#264653" class="color-option" data-color="d#264653" style="background-color: #264653;"></div>
          <div name="#2a9d8f" class="color-option" data-color="d#2a9d8f" style="background-color: #2a9d8f;"></div>
          <div name="#8d99ae" class="color-option" data-color="d#8d99ae" style="background-color: #8d99ae;"></div>
          <input type="hidden" name="selected_color" id="selectedColor">
      </div>
      
      <div class="image-upload-container" id="uploadContainer">
        <div class="upload-icon">
          <i class="fas fa-cloud-upload-alt"></i>
        </div>
        <div class="upload-text">Add Photos/Videos</div>
        <div class="upload-subtext">or drag and drop</div>
        <input type="file" id="image" name="image" accept="image/*" class="file-input">
      </div>
      
      <div class="image-preview-container" id="previewContainer">
        <img src="" alt="Preview" class="preview-image" id="previewImage">
        <button type="button" class="remove-image-btn" id="removeImageBtn">
          <i class="fas fa-times"></i>
        </button>
      </div>
      
      <div class="error-message" id="errorMessage">
        Please add either text or an image to your post
      </div>
      
      <div class="form-actions">
        <button type="submit" class="submit-btn" id="submitBtn" disabled>
          <i class="fas fa-paper-plane"></i> Post
        </button>
      </div>
    </form>
  </div>



  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const textarea = document.querySelector('.post-textarea');
      const fileInput = document.getElementById('image');
      const uploadContainer = document.getElementById('uploadContainer');
      const previewContainer = document.getElementById('previewContainer');
      const previewImage = document.getElementById('previewImage');
      const removeImageBtn = document.getElementById('removeImageBtn');
      const charCount = document.getElementById('charCount');
      const submitBtn = document.getElementById('submitBtn');
      const errorMessage = document.getElementById('errorMessage');
      const closeBtn = document.querySelector('.close-btn');
      const colorOptions = document.querySelectorAll('.color-option');
      const colorInput = document.getElementById('selectedColor');
      
      textarea.addEventListener('input', function() {
        const count = this.value.length;
        charCount.textContent = count;
        validateForm();
      });
      
      uploadContainer.addEventListener('click', function() {
        fileInput.click();
      });
      
      uploadContainer.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.classList.add('active');
      });
      
      uploadContainer.addEventListener('dragleave', function() {
        this.classList.remove('active');
      });
      
      uploadContainer.addEventListener('drop', function(e) {
        e.preventDefault();
        this.classList.remove('active');
        
        if (e.dataTransfer.files.length) {
          fileInput.files = e.dataTransfer.files;
          handleFileSelect();
        }
      });
      
      fileInput.addEventListener('change', handleFileSelect);
      
      function handleFileSelect() {
        const file = fileInput.files[0];
        
        if (file && file.type.match('image.*')) {
          const reader = new FileReader();
          
          reader.onload = function(e) {
            previewImage.src = e.target.result;
            previewContainer.style.display = 'block';
            uploadContainer.style.display = 'none';
            validateForm();
          };
          
          reader.readAsDataURL(file);
        } else {
          showError('Please select a valid image file');
        }
      }
      
      removeImageBtn.addEventListener('click', function(e) {
        e.preventDefault();
        fileInput.value = '';
        previewContainer.style.display = 'none';
        uploadContainer.style.display = '';
        validateForm();
      });
      
      colorOptions.forEach(option => {
        option.addEventListener('click', function() {
          colorOptions.forEach(opt => opt.classList.remove('selected'));
           const selectedColor = this.getAttribute('data-color');
           colorInput.value = selectedColor;
           this.classList.add('selected');
          
          
          // const selectedColor = this.getAttribute('data-color');
          textarea.style.backgroundColor = selectedColor.substring(1);
          
          fileInput.value = '';
          previewContainer.style.display = 'none';
          uploadContainer.style.display = '';
          
          validateForm();
        });
      });
      
      function validateForm() {
        const hasText = textarea.value.trim().length > 0;
        const hasImage = fileInput.files.length > 0;
        const hasBackground = textarea.style.backgroundColor && textarea.style.backgroundColor !== 'rgba(0, 0, 0, 0)';
        
        if (hasText || hasImage ) {
          submitBtn.disabled = false;
          errorMessage.style.display = 'none';
        } else {
          submitBtn.disabled = true;
        }
      }
      
      function showError(message) {
        errorMessage.textContent = message;
        errorMessage.style.display = 'block';
        setTimeout(() => {
          errorMessage.style.display = 'none';
        }, 3000);
      }
      
      closeBtn.addEventListener('click', function() {
        console.log('Close button clicked');
      });
    });
  </script>
</body>