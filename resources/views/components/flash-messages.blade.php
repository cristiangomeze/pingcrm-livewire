<div  
    id="flashMessages"
    x-data="{ shown: @entangle('shown') }"
    x-init="$watch('shown', value => {
      if (value) {
        document.getElementById('flashMessages').style.display = 'block';
      } else {
        document.getElementById('flashMessages').style.display = 'none';
      }
    })"
    style="display: none;"
    >
    <div x-show="shown " class="flex items-center justify-between mb-8 max-w-3xl bg-green-500 rounded">
      <div class="flex items-center">
        <svg class="flex-shrink-0 ml-4 mr-2 w-4 h-4 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><polygon points="0 11 2 9 7 14 18 3 20 5 7 18" /></svg>
        <div class="py-4 text-white text-sm font-medium">{{ $this->message }}</div>
      </div>
      <button type="button" class="group mr-2 p-2" @click="shown = false">
        <svg class="block w-2 h-2 fill-green-800 group-hover:fill-white" xmlns="http://www.w3.org/2000/svg" width="235.908" height="235.908" viewBox="278.046 126.846 235.908 235.908"><path d="M506.784 134.017c-9.56-9.56-25.06-9.56-34.62 0L396 210.18l-76.164-76.164c-9.56-9.56-25.06-9.56-34.62 0-9.56 9.56-9.56 25.06 0 34.62L361.38 244.8l-76.164 76.165c-9.56 9.56-9.56 25.06 0 34.62 9.56 9.56 25.06 9.56 34.62 0L396 279.42l76.164 76.165c9.56 9.56 25.06 9.56 34.62 0 9.56-9.56 9.56-25.06 0-34.62L430.62 244.8l76.164-76.163c9.56-9.56 9.56-25.06 0-34.62z" /></svg>
      </button>
    </div>
</div>