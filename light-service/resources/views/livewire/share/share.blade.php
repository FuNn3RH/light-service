<div class="container-fluid px-4 mt-3">

    <h2 class="mb-4 text-center">Share</h2>

    <div class="d-flex justify-content-between mb-4 gap-1">
        <div class="col-12 col-md-6 d-flex flex-column">
            <span class="border rounded shadow-sm p-3 w-100 d-flex flex-column"
                style="height: 200px"x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                x-on:livewire-upload-finish="uploading = false; progress = 0"
                x-on:livewire-upload-cancel="uploading = false" x-on:livewire-upload-error="uploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">

                <input class="form-control d-none" type="file" name="file" id="files" required
                    wire:model.live="file">

                <label for="files" class="form-label w-100 h-100" style="cursor: pointer;">
                    <div id="dropZone"
                        class="d-flex align-items-center justify-content-center border border-primary rounded text-center p-4 bg-light flex-grow-1 h-100"
                        ondragover="event.preventDefault();" ondrop="handleDrop(event);">
                        <span id="upload-msg">
                            <strong>Drag & drop a file here</strong><br>or click to select
                        </span>
                    </div>
                </label>

                <div x-show="uploading" class="progress mt-3" style="height: 3rem;" id="progressBox">
                    <div class="progress-bar" role="progressbar" :style="'width: ' + progress + '%'"
                        x-text="progress + '%'"></div>
                </div>

                @error('file')
                    <div class="alert alert-info mt-3">{{ $message }}</div>
                @enderror
            </span>

            <div class="row mt-5">
                @if (empty($files))
                    <div class="col-12 text-muted text-center">No files uploaded yet.</div>
                @else
                    @foreach ($files as $file)
                        <div class="col-12 col-sm-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm">

                                @if (str_contains($file['mime'], 'image/'))
                                    <img src="{{ asset($file['src'], false) }}"
                                        class="card-img-top img-fluid object-fit-cover" style="height: 100px;"
                                        loading="lazy" alt="{{ htmlspecialchars($file['name']) }}">
                                @endif

                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title text-truncate">{{ htmlspecialchars($file['name']) }}</h6>
                                    <p class="card-text mb-1"><small>{{ humanFileSize($file['size']) }}</small></p>
                                    <p class="card-text"><small>{{ $file['created_at'] }}</small></p>

                                    <span class="d-flex justify-content-around align-items-center gap-1 mt-auto">
                                        <button wire:click="download({{ $file['id'] }})"
                                            class="btn btn-sm btn-success flex-grow-1">
                                            Download
                                        </button>

                                        <button wire:click="delete({{ $file['id'] }})"
                                            class="btn btn-sm btn-danger flex-grow-2"
                                            wire:confirm="Are you sure you want to delete this file?">Delete</button>
                                    </span>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

        </div>

        <div class="col-12 col-md-6 d-flex flex-column gap-1">

            <div>
                <span class="border rounded shadow-sm p-3 w-100 d-flex flex-column position-relative"
                    style="height: 200px;">
                    <!-- Copy button -->
                    <span class="position-absolute p-2" x-data
                        style="right:20px; top:20px; cursor:pointer;font-size:1.5rem;filter: drop-shadow(0px 0px 12px rgba(0, 0, 0, 0.89));"
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

            <div class="mt-2 align-self-end d-none">
                <button class="btn btn-primary" @click="generateTextField(event.target)">Add Text</button>
            </div>

        </div>
    </div>


</div>
