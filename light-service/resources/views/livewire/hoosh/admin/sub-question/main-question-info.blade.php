<div class="accordion my-3">
    <div class="accordion-item">
        <h2 class="accordion-header px-4 py-2 bg-info">
            <p class="mb-0">{{ $mainQuestion['title'] }}</p>
        </h2>
        <div class="accordion-collapse collapse show">
            <div class="accordion-body">
                <p class="fs-5">{{ nl2br(e($mainQuestion->content)) }}</p>
                <div class="text-center mx-auto">
                    <img src="{{ asset('storage/' . $mainQuestion['image']) }}"
                        class="img-fluid rounded shadow-sm preview-image" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
