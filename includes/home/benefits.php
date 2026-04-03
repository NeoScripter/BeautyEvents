<div
    class="grid gap-4 grid-cols-[repeat(auto-fill,minmax(280px,1fr))] lg:grid-cols-2"
    id="advantages-grid">
    <?php $order = 1; ?>
    <?php if (have_rows('benefit_cards')): while (have_rows('benefit_cards')): the_row(); ?>
            <div
                class="p-4 xl:p-6 rounded-2xl bg-dark-gray h-66 flex w-full flex-col justify-between text-white transition-colors duration-300 hover:bg-primary-pink active:bg-primary-pink focus:bg-primary-pink">
                <div class="flex items-start justify-between gap-1">
                    <div
                        class="uppercase font-semibold text-xl lg:text-2xl advantages-title text-balance"><?php echo get_sub_field('title'); ?></div>
                    <div
                        class="p-2 rounded-full bg-white flex items-center justify-center text-primary-pink w-10 h-10 text-sm shrink-0 advantages-order"><?php echo '0' . $order++; ?></div>
                </div>

                <p
                    class="text-sm advantages-description xl:max-w-3/4 lg:text-base"><?php echo get_sub_field('content'); ?></p>
            </div>
    <?php endwhile;
    endif; ?>
</div>
