<?php $__env->startSection('content'); ?>
<div class="flex justify-center mx-auto px-4 py-8">
    <div class="w-full max-w-[96rem]">
        <h1 class="text-5xl font-bold text-center mb-8" style="text-shadow: 0px 0px 20px rgba(240, 229, 15, 0.876);">
            Choose your question set
        </h1>

        <div id="test-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mx-auto">
            <?php $__empty_1 = true; $__currentLoopData = $writingTests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="test-item bg-[rgba(143,129,129,0.3)] p-5 rounded-[30px] shadow hover:translate-y-[-4px] hover:shadow-lg transition duration-300 text-center" data-index="<?php echo e($index); ?>">
                    <h2 class="text-xl font-semibold mb-3" style="text-shadow: 0px 0px 20px rgba(240, 229, 15, 0.876);">
                        <?php echo e($test->title); ?>

                    </h2>

                    <?php if($test->image): ?>
                        <img src="<?php echo e(asset('image/' . $test->image)); ?>" alt="<?php echo e($test->title); ?>" class="w-full h-48 object-cover rounded-lg mb-4">
                    <?php endif; ?>

                    <p class="text-gray-600 mb-4">
                        <?php echo e(Str::limit($test->description, 100)); ?>

                    </p>

                    <a href="<?php echo e(route('writing.test.show', ['id' => $test->id])); ?>"
                       class="inline-block bg-[rgba(242,222,156,1)] text-[rgba(111,82,37,1)] px-4 py-2 rounded-full no-underline transition duration-300 hover:bg-yellow-200 hover:shadow-[0_0_20px_rgba(218,208,32,0.876)]">
                       Làm bài
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="col-span-3 text-center text-gray-500 text-lg">
                    Không có bài viết nào.
                </p>
            <?php endif; ?>
        </div>

        <!-- Navigation buttons -->
        <div class="mt-8 flex justify-center space-x-4">
            <button id="prevBtn"
                class="w-[60px] h-[60px] bg-gray-300 rounded-full hover:bg-gray-400 disabled:opacity-50 flex items-center justify-center"
                disabled>
                <img src="<?php echo e(asset('icon/left.svg')); ?>" alt="icon" class="w-10 h-10" />
            </button>

            <button id="nextBtn"
                class="w-[60px] h-[60px] bg-yellow-400 rounded-full hover:bg-yellow-500 flex items-center justify-center">
                <img src="<?php echo e(asset('icon/right.svg')); ?>" alt="icon" class="w-10 h-10" />
            </button>

        </div>
    </div>
</div>

<!-- Pagination Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const items = document.querySelectorAll('.test-item');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const perPage = 6;
        let currentPage = 0;

        function showPage(page) {
            const start = page * perPage;
            const end = start + perPage;

            items.forEach((item, index) => {
                item.style.display = (index >= start && index < end) ? 'block' : 'none';
            });

            prevBtn.disabled = page === 0;
            nextBtn.disabled = end >= items.length;
        }

        prevBtn.addEventListener('click', function () {
            if (currentPage > 0) {
                currentPage--;
                showPage(currentPage);
            }
        });

        nextBtn.addEventListener('click', function () {
            if ((currentPage + 1) * perPage < items.length) {
                currentPage++;
                showPage(currentPage);
            }
        });

        // Initial display
        showPage(currentPage);
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Admin\Downloads\SE-Project-main (4)\SE-Project-main\resources\views/writing/index.blade.php ENDPATH**/ ?>