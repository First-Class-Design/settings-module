<?php
/**
 * Template Part / ACF Block: Portfolio Gallery Section
 * ACF Pro Field: portfolio_gallery_images
 *
 * Layout:
 * - 2 Columns on Mobile
 * - 3 Columns on Tablet & Desktop
 * - Built-in Vanilla JS Lightbox with thumbnail strip, keyboard controls & caption support
 * - Gutenberg Block Compatible with editor preview placeholders
 */

// ACF Block context variables
$is_block_preview = !empty($is_preview);
$block_id         = !empty($block['id']) ? $block['id'] : uniqid();
$gallery_uid      = 'custom_gallery_' . sanitize_html_class($block_id);

// Retrieve gallery images (works automatically for blocks and standard templates)
$gallery_images = get_field('portfolio_gallery_images');

// Retrieve block display options (defaults to showing titles if unconfigured)
$show_titles_field = get_field('show_image_titles');
$show_titles       = ($show_titles_field === null || $show_titles_field === '') ? true : (bool) $show_titles_field;
$is_full_width     = (bool) get_field('full_width_gallery') || (!empty($block['align']) && $block['align'] === 'full');

// Editor Placeholder: If inside Gutenberg and no images are selected yet
if (empty($gallery_images)) {
    if ($is_block_preview) {
        ?>
        <div style="border: 2px dashed #94a3b8; padding: 2.5rem 1.5rem; text-align: center; border-radius: 8px; background: #f8fafc; color: #475569; font-family: sans-serif;">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 0.75rem; display: block;">
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                <polyline points="21 15 16 10 5 21"></polyline>
            </svg>
            <strong style="display: block; font-size: 1rem; margin-bottom: 0.25rem;">Portfolio Gallery Block</strong>
            <span style="font-size: 0.875rem;">Select images in the block settings on the right sidebar to populate this gallery.</span>
        </div>
        <?php
    }
    return;
}
?>

<style>
  /* --- Gallery Grid Scoped Styles --- */
  .custom_portfolio-gallery-section {
    width: 100%;
    padding: 2rem 0rem;
    box-sizing: border-box;
  }

  /* Full Width Breakout: Extends edge-to-edge across the viewport */
  .custom_portfolio-gallery-section.custom_is-full-width {
    width: calc(100vw - 4rem);
    position: relative;
    left: 50%;
    right: 50%;
    margin-left: calc(-50vw + 2rem);
    margin-right: calc(-50vw + 2rem);
    max-width: calc(100vw - 4rem);
    padding-left: 0;
    padding-right: 0;
  }

  /* Prevent canvas overflow inside Gutenberg editor preview */
  body.wp-admin .custom_portfolio-gallery-section.custom_is-full-width {
    width: 100%;
    left: auto;
    right: auto;
    margin-left: 0;
    margin-right: 0;
  }

  .custom_portfolio-gallery-grid {
    display: grid;
    /* 2 columns on mobile */
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
    list-style: none;
    padding: 0;
    margin: 0;
  }

  /* 3 columns on desktop (768px and up) */
  @media (min-width: 768px) {
    .custom_portfolio-gallery-grid {
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
    }
  }

  /* Gallery Item Cards */
  .custom_gallery-item {
    position: relative;
    overflow: hidden;
    background-color: #f1f5f9;
    aspect-ratio: 3 / 2;
    cursor: pointer;
    transition: transform 0.25s ease;
  }

  .custom_gallery-item:hover {
    transform: translateY(-3px);
  }

  .custom_gallery-item-button {
    all: unset;
    display: block;
    width: 100%;
    height: 100%;
    cursor: pointer;
  }

  .custom_gallery-item-button:focus-visible {
    outline: 3px solid #2563eb;
    outline-offset: 2px;
  }

  .custom_gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.4s ease;
  }

  .custom_gallery-item:hover img {
    transform: scale(1.05);
  }

  .custom_gallery-item-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0) 55%);
    opacity: 0;
    display: flex;
    align-items: flex-end;
    padding: 14px;
    color: #ffffff;
    transition: opacity 0.25s ease;
    pointer-events: none;
  }

  .custom_gallery-item:hover .custom_gallery-item-overlay {
    opacity: 1;
  }

  .custom_gallery-item-title {
    font-size: 0.875rem;
    font-weight: 500;
    line-height: 1.25;
    text-shadow: 0 1px 3px rgba(0,0,0,0.8);
  }

  /* --- Lightbox Styles --- */
  .custom_lightbox {
    position: fixed;
    inset: 0;
    z-index: 99999;
    background: rgba(10, 10, 15, 0.94);
    backdrop-filter: blur(8px);
    display: flex;
    flex-direction: column;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease, visibility 0.3s ease;
  }

  .custom_lightbox.custom_is-open {
    opacity: 1;
    visibility: visible;
  }

  /* Lightbox Header Bar */
  .custom_lightbox-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 1.5rem;
    color: #fff;
    z-index: 10;
  }

  .custom_lightbox-counter {
    font-size: 0.875rem;
    letter-spacing: 0.05em;
    color: #cbd5e1;
  }

  .custom_lightbox-close-btn {
    background: rgba(255, 255, 255, 0.12);
    border: none;
    color: #ffffff;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.2s, transform 0.2s;
  }

  .custom_lightbox-close-btn:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: scale(1.05);
  }

  /* Lightbox Main Stage */
  .custom_lightbox-stage {
    flex: 1;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 1rem;
    min-height: 0;
    overflow: hidden;
    user-select: none;
    -webkit-user-select: none;
  }

  /* Slider viewport and track for smooth sliding & dragging */
  .custom_lightbox-slider-viewport {
    width: 100%;
    max-width: 90vw;
    overflow: hidden;
    cursor: grab;
    touch-action: pan-y;
  }

  .custom_lightbox-slider-viewport.custom_is-dragging {
    cursor: grabbing;
  }

  .custom_lightbox-slider-track {
    display: flex;
    width: 100%;
    transition: transform 0.35s cubic-bezier(0.25, 1, 0.5, 1);
    will-change: transform;
  }

  .custom_lightbox-slide {
    flex: 0 0 100%;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    max-height: 72vh;
    box-sizing: border-box;
  }

  .custom_lightbox-content-wrap {
    max-width: 90vw;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }

  .custom_lightbox-main-img {
    max-width: 100%;
    max-height: 72vh;
    object-fit: contain;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
    user-select: none;
    -webkit-user-drag: none;
    pointer-events: none;
  }

  .custom_lightbox-caption {
    margin-top: 10px;
    color: #e2e8f0;
    font-size: 0.95rem;
    text-align: center;
    max-width: 750px;
    line-height: 1.4;
  }

  /* Nav Arrows */
  .custom_lightbox-nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.15);
    border: none;
    color: #ffffff;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.2s, transform 0.2s;
    z-index: 5;
  }

  .custom_lightbox-nav-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-50%) scale(1.08);
  }

  .custom_lightbox-nav-prev { left: 1rem; }
  .custom_lightbox-nav-next { right: 1rem; }

  @media (max-width: 768px) {
    .custom_lightbox-nav-btn {
      width: 38px;
      height: 38px;
    }
  }

  /* Thumbnail Tray */
  .custom_lightbox-thumbnails-wrapper {
    padding: 12px 1rem 16px;
    overflow-x: auto;
    display: flex;
    justify-content: center;
    scrollbar-width: thin;
    scrollbar-color: rgba(255, 255, 255, 0.2) transparent;
  }

  .custom_lightbox-thumbnails-list {
    display: flex;
    gap: 8px;
    list-style: none;
    padding: 0;
    margin: 0;
    overflow: auto;
  }

  .custom_lightbox-thumb-item {
    flex-shrink: 0;
    width: 64px;
    height: 64px;
    border-radius: 6px;
    overflow: hidden;
    cursor: pointer;
    border: 2px solid transparent;
    opacity: 0.55;
    transition: opacity 0.2s, border-color 0.2s, transform 0.2s;
  }

  .custom_lightbox-thumb-item:hover {
    opacity: 0.85;
    transform: translateY(-2px);
  }

  .custom_lightbox-thumb-item.custom_is-active {
    opacity: 1;
    border-color: #38bdf8;
    transform: scale(1.05);
  }

  .custom_lightbox-thumb-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }
</style>

<section class="custom_portfolio-gallery-section<?php echo $is_full_width ? ' custom_is-full-width' : ''; ?>" id="<?php echo esc_attr($gallery_uid); ?>" aria-label="Portfolio Image Gallery">
  <ul class="custom_portfolio-gallery-grid">
    <?php
    $index = 0;
    foreach ($gallery_images as $image) :
        // Support both ACF Image Array format and ID-only format
        if (is_array($image)) {
            $img_id    = $image['id'] ?? 0;
            $full_url  = $image['url'] ?? '';
            $thumb_url = $image['sizes']['large'] ?? $image['sizes']['medium'] ?? $full_url;
            $alt_text  = !empty($image['alt']) ? $image['alt'] : ($image['title'] ?? 'Portfolio Image');
            $caption   = $image['caption'] ?? '';
            $title     = $image['title'] ?? '';
        } else {
            $img_id    = (int) $image;
            $full_url  = wp_get_attachment_image_url($img_id, 'full');
            $thumb_url = wp_get_attachment_image_url($img_id, 'large') ?: wp_get_attachment_image_url($img_id, 'medium');
            $alt_text  = get_post_meta($img_id, '_wp_attachment_image_alt', true) ?: get_the_title($img_id);
            $caption   = wp_get_attachment_caption($img_id);
            $title     = get_the_title($img_id);
        }
    ?>
      <li class="custom_gallery-item">
        <button
          type="button"
          class="custom_gallery-item-button"
          data-index="<?php echo esc_attr($index); ?>"
          aria-label="View <?php echo esc_attr($alt_text); ?> in full screen"
          <?php if ($is_block_preview) echo 'tabindex="-1" style="pointer-events: none;"'; ?>
        >
          <img
            src="<?php echo esc_url($thumb_url); ?>"
            alt="<?php echo esc_attr($alt_text); ?>"
            loading="lazy"
            width="600"
            height="600"
          />
          <?php if ($show_titles && !empty($title)) : ?>
            <div class="custom_gallery-item-overlay">
              <span class="custom_gallery-item-title"><?php echo esc_html($title); ?></span>
            </div>
          <?php endif; ?>
        </button>
      </li>
    <?php
      $index++;
    endforeach;
    ?>
  </ul>

  <div
    class="custom_lightbox"
    id="<?php echo esc_attr($gallery_uid); ?>_lightbox"
    role="dialog"
    aria-modal="true"
    aria-hidden="true"
  >
    <!-- Lightbox Top Bar -->
    <div class="custom_lightbox-header">
      <div class="custom_lightbox-counter" id="<?php echo esc_attr($gallery_uid); ?>_counter">1 / <?php echo count($gallery_images); ?></div>
      <button
        type="button"
        class="custom_lightbox-close-btn"
        id="<?php echo esc_attr($gallery_uid); ?>_close"
        aria-label="Close Lightbox (Esc)"
      >
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>
    </div>

    <!-- Center Stage -->
    <div class="custom_lightbox-stage">
      <button
        type="button"
        class="custom_lightbox-nav-btn custom_lightbox-nav-prev"
        id="<?php echo esc_attr($gallery_uid); ?>_prev"
        aria-label="Previous Image"
      >
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="15 18 9 12 15 6"></polyline>
        </svg>
      </button>

      <div class="custom_lightbox-content-wrap">
        <div class="custom_lightbox-slider-viewport" id="<?php echo esc_attr($gallery_uid); ?>_slider_viewport">
          <div class="custom_lightbox-slider-track" id="<?php echo esc_attr($gallery_uid); ?>_slider_track">
            <?php foreach ($gallery_images as $s_img) :
                if (is_array($s_img)) {
                    $s_src = $s_img['url'] ?? '';
                    $s_alt = !empty($s_img['alt']) ? $s_img['alt'] : ($s_img['title'] ?? '');
                } else {
                    $s_id  = (int) $s_img;
                    $s_src = wp_get_attachment_image_url($s_id, 'full');
                    $s_alt = get_post_meta($s_id, '_wp_attachment_image_alt', true) ?: get_the_title($s_id);
                }
            ?>
              <div class="custom_lightbox-slide">
                <img
                  class="custom_lightbox-main-img"
                  src="<?php echo esc_url($s_src); ?>"
                  alt="<?php echo esc_attr($s_alt); ?>"
                  loading="lazy"
                  draggable="false"
                />
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="custom_lightbox-caption" id="<?php echo esc_attr($gallery_uid); ?>_caption"></div>
        <a
          class="master-button"
          id="<?php echo esc_attr($gallery_uid); ?>_case_study_btn"
          href="#"
          style="display: none; align-items: center; gap: 0.5rem;"
        >
          <span>View Case Study</span>
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
            <polyline points="15 3 21 3 21 9"></polyline>
            <line x1="10" y1="14" x2="21" y2="3"></line>
          </svg>
        </a>
      </div>

      <button
        type="button"
        class="custom_lightbox-nav-btn custom_lightbox-nav-next"
        id="<?php echo esc_attr($gallery_uid); ?>_next"
        aria-label="Next Image"
      >
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="9 18 15 12 9 6"></polyline>
        </svg>
      </button>
    </div>

    <!-- Bottom Thumbnail Navigation -->
    <div class="custom_lightbox-thumbnails-wrapper">
      <ul class="custom_lightbox-thumbnails-list" id="<?php echo esc_attr($gallery_uid); ?>_thumbs_list">
        <?php
        $t_index = 0;
        foreach ($gallery_images as $image) :
            if (is_array($image)) {
                $t_thumb = $image['sizes']['thumbnail'] ?? $image['url'];
                $t_alt   = $image['alt'] ?? '';
            } else {
                $t_thumb = wp_get_attachment_image_url((int)$image, 'thumbnail');
                $t_alt   = get_post_meta((int)$image, '_wp_attachment_image_alt', true);
            }
        ?>
          <li
            class="custom_lightbox-thumb-item"
            data-index="<?php echo esc_attr($t_index); ?>"
            role="button"
            tabindex="0"
            aria-label="Jump to image <?php echo esc_attr($t_index + 1); ?>"
          >
            <img src="<?php echo esc_url($t_thumb); ?>" alt="<?php echo esc_attr($t_alt); ?>" loading="lazy" />
          </li>
        <?php
          $t_index++;
        endforeach;
        ?>
      </ul>
    </div>
  </div>
</section>

<?php
// Prepare image dataset for the JS controller
$js_images_data = [];

// Ensure post ID check functions properly inside Gutenberg blocks or standard templates
$current_post_id = !empty($post_id) && is_numeric($post_id) ? (int)$post_id : get_the_ID();
$is_case_studies_post_type = (get_post_type($current_post_id) === 'case-studies');

foreach ($gallery_images as $image) {
    if (is_array($image)) {
        $img_id   = $image['id'] ?? 0;
        $src      = $image['url'] ?? '';
        $alt      = !empty($image['alt']) ? $image['alt'] : ($image['title'] ?? '');
        $caption  = $image['caption'] ?? '';
    } else {
        $img_id   = (int) $image;
        $src      = wp_get_attachment_image_url($img_id, 'full');
        $alt      = get_post_meta($img_id, '_wp_attachment_image_alt', true) ?: get_the_title($img_id);
        $caption  = wp_get_attachment_caption($img_id) ?: '';
    }

    // Retrieve custom case study link attached to this image (supports URL, Link array, or Post ID)
    // If we're already on a 'case-studies' post type page, suppress the link entirely
    $case_study_url = '';
    if (!$is_case_studies_post_type && $img_id) {
        $case_study_raw = get_field('case_study_url', $img_id);

        if (is_array($case_study_raw) && !empty($case_study_raw['url'])) {
            $case_study_url = $case_study_raw['url'];
        } elseif (is_numeric($case_study_raw)) {
            $case_study_url = get_permalink((int)$case_study_raw);
        } elseif (is_string($case_study_raw)) {
            $case_study_url = $case_study_raw;
        }
    }

    $js_images_data[] = [
        'src'            => $src,
        'alt'            => $alt,
        'caption'        => $caption,
        'case_study_url' => esc_url($case_study_url),
    ];
}
?>

<?php if (!$is_block_preview) : ?>
<script>
(function() {
  const galleryUid = <?php echo json_encode($gallery_uid); ?>;
  const images = <?php echo json_encode($js_images_data); ?>;
  
  const container = document.getElementById(galleryUid);
  const lightbox = document.getElementById(galleryUid + '_lightbox');
  const sliderViewport = document.getElementById(galleryUid + '_slider_viewport');
  const sliderTrack = document.getElementById(galleryUid + '_slider_track');
  const captionEl = document.getElementById(galleryUid + '_caption');
  const caseStudyBtn = document.getElementById(galleryUid + '_case_study_btn');
  const counterEl = document.getElementById(galleryUid + '_counter');
  const closeBtn = document.getElementById(galleryUid + '_close');
  const prevBtn = document.getElementById(galleryUid + '_prev');
  const nextBtn = document.getElementById(galleryUid + '_next');
  const thumbsList = document.getElementById(galleryUid + '_thumbs_list');
  const thumbs = thumbsList.querySelectorAll('.custom_lightbox-thumb-item');

  let currentIndex = 0;
  let lastActiveElement = null;

  // Drag / Swipe gesture states
  let isDragging = false;
  let startX = 0;
  let currentTranslateX = 0;
  let prevTranslateX = 0;
  let animationFrameId = null;

  function setSliderPosition() {
    sliderTrack.style.transform = `translateX(${currentTranslateX}px)`;
  }

  function updateSliderPosition(animate = true) {
    if (animate) {
      sliderTrack.style.transition = 'transform 0.35s cubic-bezier(0.25, 1, 0.5, 1)';
    } else {
      sliderTrack.style.transition = 'none';
    }
    const slideWidth = sliderViewport.offsetWidth;
    currentTranslateX = -currentIndex * slideWidth;
    prevTranslateX = currentTranslateX;
    setSliderPosition();
  }

  function displayImage(index, animate = true) {
    if (index < 0) index = images.length - 1;
    if (index >= images.length) index = 0;
    
    currentIndex = index;
    const current = images[currentIndex];

    // Slide track to current image position
    updateSliderPosition(animate);

    // Update Caption & Counter
    captionEl.textContent = current.caption || '';
    counterEl.textContent = `${currentIndex + 1} / ${images.length}`;

    // Toggle Case Study Button
    if (current.case_study_url) {
      caseStudyBtn.href = current.case_study_url;
      caseStudyBtn.style.display = 'inline-flex';
    } else {
      caseStudyBtn.style.display = 'none';
      caseStudyBtn.removeAttribute('href');
    }

    // Update Thumbnail active state and auto-scroll into view
    thumbs.forEach((thumb, idx) => {
      if (idx === currentIndex) {
        thumb.classList.add('custom_is-active');
        thumb.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
      } else {
        thumb.classList.remove('custom_is-active');
      }
    });
  }

  function openLightbox(index) {
    lastActiveElement = document.activeElement;
    lightbox.classList.add('custom_is-open');
    lightbox.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';

    // Set position immediately without transition when first opening
    requestAnimationFrame(() => {
      displayImage(index, false);
    });

    closeBtn.focus();
    window.addEventListener('keydown', handleKeydown);
    window.addEventListener('resize', handleResize);
  }

  function closeLightbox() {
    lightbox.classList.remove('custom_is-open');
    lightbox.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
    window.removeEventListener('keydown', handleKeydown);
    window.removeEventListener('resize', handleResize);
    if (lastActiveElement) {
      lastActiveElement.focus();
    }
  }

  function handleResize() {
    updateSliderPosition(false);
  }

  function handleKeydown(e) {
    if (e.key === 'Escape') {
      closeLightbox();
    } else if (e.key === 'ArrowRight') {
      displayImage(currentIndex + 1);
    } else if (e.key === 'ArrowLeft') {
      displayImage(currentIndex - 1);
    }
  }

  // Touch and Mouse Drag Implementation
  function getPositionX(e) {
    return e.type.includes('mouse') ? e.pageX : e.touches[0].clientX;
  }

  function dragStart(e) {
    if (e.type === 'mousedown' && e.button !== 0) return; // Only left-click
    isDragging = true;
    startX = getPositionX(e);
    sliderViewport.classList.add('custom_is-dragging');
    sliderTrack.style.transition = 'none';
  }

  function dragMove(e) {
    if (!isDragging) return;
    const currentX = getPositionX(e);
    const diffX = currentX - startX;
    currentTranslateX = prevTranslateX + diffX;
    
    if (animationFrameId) cancelAnimationFrame(animationFrameId);
    animationFrameId = requestAnimationFrame(setSliderPosition);
  }

  function dragEnd() {
    if (!isDragging) return;
    isDragging = false;
    sliderViewport.classList.remove('custom_is-dragging');
    if (animationFrameId) cancelAnimationFrame(animationFrameId);

    const movedBy = currentTranslateX - prevTranslateX;
    const threshold = 50; // Minimum drag distance in pixels to trigger slide

    if (movedBy < -threshold) {
      displayImage(currentIndex + 1);
    } else if (movedBy > threshold) {
      displayImage(currentIndex - 1);
    } else {
      // Snap back if threshold not met
      updateSliderPosition(true);
    }
  }

  // Pointer / Touch / Mouse Events
  sliderViewport.addEventListener('touchstart', dragStart, { passive: true });
  sliderViewport.addEventListener('touchmove', dragMove, { passive: true });
  sliderViewport.addEventListener('touchend', dragEnd);

  sliderViewport.addEventListener('mousedown', dragStart);
  window.addEventListener('mousemove', dragMove);
  window.addEventListener('mouseup', dragEnd);

  // Trigger from Grid Items
  const gridButtons = container.querySelectorAll('.custom_gallery-item-button');
  gridButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      const idx = parseInt(btn.getAttribute('data-index'), 10);
      openLightbox(idx);
    });
  });

  // Lightbox Controls
  closeBtn.addEventListener('click', closeLightbox);
  prevBtn.addEventListener('click', () => displayImage(currentIndex - 1));
  nextBtn.addEventListener('click', () => displayImage(currentIndex + 1));

  // Lightbox Background Click (Close when clicking outside track/controls)
  lightbox.addEventListener('click', (e) => {
    if (e.target === lightbox || e.target.classList.contains('custom_lightbox-stage')) {
      closeLightbox();
    }
  });

  // Thumbnail Tray Click
  thumbs.forEach(thumb => {
    thumb.addEventListener('click', () => {
      const idx = parseInt(thumb.getAttribute('data-index'), 10);
      displayImage(idx);
    });
    thumb.addEventListener('keydown', (e) => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        const idx = parseInt(thumb.getAttribute('data-index'), 10);
        displayImage(idx);
      }
    });
  });
})();
</script>
<?php endif; ?>