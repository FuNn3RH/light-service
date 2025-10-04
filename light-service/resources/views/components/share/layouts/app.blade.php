<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share</title>
    <link href="{{ asset('assets/share/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ vAsset('assets/share/css/style.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ vAsset('assets/share/img/web-icon.png') }}">

    <style>
        textarea.form-control {
            height: 200px;
            resize: vertical;
        }

        @media (max-width: 768px) {
            #dropZone {
                padding: 2rem;
            }
        }
    </style>

    @livewireStyles
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">

    {{ $slot }}

    @livewireScripts
    <script>
        function copy(el) {
            el.select();
            document.execCommand("copy");
            alert("Text copied to clipboard");
        }

        const fileInput = document.getElementById('files');

        function handleDrop(event) {
            event.preventDefault();
            const files = event.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
            }

            document.getElementById('upload-msg').innerHTML = "<strong>Uploaded: " + files[0].name + "</strong>";
        }

        function deleteConfirm(e, message) {

            if (!confirm(message)) {
                e.preventDefault();
                return
            }
        }

        function generateTextField(el) {
            el.parentElement.insertAdjacentHTML('beforebegin', `
            <div>
                <span class="border rounded shadow-sm p-3 w-100 d-flex flex-column position-relative"
                    style="height: 200px;">
                    <!-- Copy button -->
                    <span class="position-absolute badge p-2" x-data
                        style="background-color: #b8b8b88e; right:20px; top:20px; cursor:pointer;font-size:1.1rem"
                        @click="copy($refs.textarea)">
                        📄
                    </span>

                    <!-- Textarea -->
                    <textarea x-ref="textarea" class="form-control flex-grow-1 w-100" id="textarea" wire:model.live.debounce.500ms="text"></textarea>

                    <!-- Livewire Loading -->
                    <span wire:loading wire:target="text" class="badge text-bg-success mt-2"
                        style="width: max-content;">
                        Saving...
                    </span>
                </span>
            </div>
        `)
        }
    </script>

</body>

</html>
