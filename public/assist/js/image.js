    document.addEventListener('DOMContentLoaded', function() {
      const fileInput = document.getElementById('image');
      const imagePreview = document.getElementById('image-preview');
      const defaultImage = document.getElementById('default-image');
      
      fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
          const reader = new FileReader();
          
          reader.onload = function(e) {
            // Display the image preview
            imagePreview.src = e.target.result;
            imagePreview.classList.remove('hidden');
            defaultImage.classList.add('hidden');
          }
          
          reader.readAsDataURL(this.files[0]);
        }
      });
    });