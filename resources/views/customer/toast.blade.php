<div id="toast" class="fixed z-10 top-5 right-5 bg-green-600 text-white font-bold px-4 py-2 rounded-lg shadow-lg hidden">
    <div>
      <i class="fa fa-check-circle mr-1"></i>
      <span class="text">Success!</span>
    </div>
    <div class="progressbar h-1 w-full bg-green-800 relative overflow-hidden mt-1"></div>
  </div>
  
  <div id="error-toast" class="fixed z-10 top-5 right-5 bg-red-600 text-white font-bold px-4 py-2 rounded-lg shadow-lg hidden">
    <div>
      <i class="fa fa-exclamation-circle mr-1"></i>
      <span class="text">Error!</span>
    </div>
    <div class="progressbar h-1 w-full bg-red-800 relative overflow-hidden mt-1"></div>
  </div>
  
  <style>  
    .progressbar:before {
      content: "";
      height: 100%;
      position: absolute;
      background-color: #ddd;
      animation: progress 4s linear;
    }
  
    @keyframes progress {
      0% {
        width: 0%;
      }
      100% {
        width: 100%;
      }
    }
  </style>
  
  <script>
    function showToast(message) {
      $('#toast .text').text(message);
      $('#toast').removeClass('hidden');
      setTimeout(function() {
        $('#toast').addClass('hidden');
      }, 4050);
    }
  
    function showErrorToast(message) {
      $('#error-toast .text').text(message);
      $('#error-toast').removeClass('hidden');
      setTimeout(function() {
        $('#error-toast').addClass('hidden');
      }, 4050);
    }
  </script>
  
  @if (isset($success))
    <script>
      showToast('{{ $success }}');
    </script>
  @endif
  
  @if (isset($error))
    <script>
      showErrorToast('{{ $error }}');
    </script>
  @endif