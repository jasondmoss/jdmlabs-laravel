<div x-data="fileUpload()" wire:ignore class="form-field signature-image">

  <div class="absolute top-0 bottom-0 left-0 right-0 z-30 flex items-center justify-center bg-blue-500 opacity-90" x-show="isDropping">
    <span class="text-3xl text-white">Release file to upload!</span>
  </div>

  <div class="flex flex-col items-center justify-center bg-slate-200">
    <label class="flex flex-col items-center justify-center w-1/2 bg-white border shadow cursor-pointer h-1/2 rounded-2xl hover:bg-slate-50" for="signature_image">
      {{ __('Signature Image') }}
      <h3 class="text-3xl">Click here to select files to upload</h3>
      <em class="italic text-slate-400">(Or drag files to the page)</em>

      <div class="bg-gray-200 h-[2px] w-1/2 mt-3">
        <div class="bg-blue-500 h-[2px]" style="transition: width 1s" :style="`width: ${progress}%;`" x-show="isUploading"></div>
      </div>

      @if (count($signature_image))
        <div class="mt-5">
          @foreach ($signature_image as $simg)
            <img src="{{ $simg->temporaryUrl() }}" alt="">
            <button type="button" class="text-red-500" @click="removeUpload('{{ $simg->getFilename() }}')">X</button>
          @endforeach
        </div>
      @endif

      <input type="file" name="signature_image" @change="handleFileSelect" class="hidden"/>
    </label>
  </div>

  <script>
function fileUpload () {
    return {
        isDropping: false,
        isUploading: false,
        progress: 0,

        handleFileSelect (event) {
            if (event.target.files.length) {
                console.log(event.target.files);
            }
        },

        // handleFileDrop (event) {
        //     if (event.dataTransfer.files.length > 0) {
        //         this.uploadFiles(event.dataTransfer.files)
        //     }
        // },

        uploadFiles (signature_image) {
          const $this = this;

          this.isUploading = true;

          @this.uploadMultiple("signature_image", signature_image, function (success) {
              // Upload has finished successfully.
              $this.isUploading = false;
              $this.progress = 0;
          }, function (error) {
              // An error occurred.
              console.log("error", error);
          }, function (event) {
              // Upload progress was made.
              $this.progress = event.detail.progress;
          });
        },

        removeUpload (filename) {
            @this.removeUpload("signature_image", filename);
        }
    };
}
  </script>
</div>
