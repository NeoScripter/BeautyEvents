<div
    class="grid gap-10 md:grid-cols-2 xl:grid-cols-4"
    id="grid-output">

    <?php

    $card_links = array(
        'https://beautytrainingdesign.com/collections/pmu-basic-course',  // 01
        'https://beautytrainingdesign.com/collections/lash',              // 02
        'https://beautytrainingdesign.com/products/table-of-pigments-professional-reference-chart-a4-pdf-download-%D0%BA%D0%BE%D0%BF%D0%B8%D1%8F',  // 03
        'https://beautytrainingdesign.com/collections/1',                 // 04
    );

    $images = get_field('training_carousel');
    $count = 1;
    ?>
    <?php if ($images): ?>
        <?php foreach ($images as $index => $image): ?>
            <?php $link = isset($card_links[$index]) ? $card_links[$index] : '#'; ?>

            <a href="<?= esc_url($link); ?>" target="_blank" class="max-w-80 mx-auto w-full carosel-card md:flex md:flex-col block hover:opacity-90 transition-opacity">
                <div class="overflow-hidden aspect-square relative rounded-tr-xl rounded-tl-xl">
                    <img
                        src="<?= esc_url(is_array($image) ? $image['url'] : $image); ?>"
                        alt="<?= esc_attr(is_array($image) ? $image['alt'] : ''); ?>"
                        class="w-full object-cover object-center h-full" />
                </div>
                <div
                    class="bg-primary-pink z-10 w-4/5 mx-auto text-primary-black/50 pb-1 text-5xl text-center rounded-br-xl rounded-bl-xl relative">
                    <?php echo str_pad($count++, 2, '0', STR_PAD_LEFT); ?>
                    <div
                        class="absolute bg-primary-pink bottom-3 -z-10 w-24 h-14 left-1/2 -translate-x-1/2"
                        style="border-radius: 50% 50% 50% 50% / 100% 100% 0% 0%;"></div>
                </div>
            </a>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
