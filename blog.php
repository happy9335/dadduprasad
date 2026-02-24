<?php
require_once 'includes/header.php';

// Fetch all blog posts
$stmt = $pdo->query("SELECT * FROM blog_posts ORDER BY publish_date DESC");
$blogs = $stmt->fetchAll();

// Determine language
$lang = $_COOKIE['lang'] ?? 'hi';
?>
<style>
/* Blog Hero Section */
.blog-hero {
    background: linear-gradient(135deg, #003893 0%, #00235c 100%);
    padding: 80px 0 60px;
    color: #ffffff;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.blog-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url('https://www.transparenttextures.com/patterns/cubes.png');
    opacity: 0.05;
}
.blog-hero-title {
    font-family: 'Mukta', 'Noto Sans Devanagari', sans-serif;
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 15px;
    position: relative;
    z-index: 1;
}
.blog-hero-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
    max-width: 600px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
}
.blog-hero-rule {
    width: 60px;
    height: 4px;
    background: #FECB00;
    margin: 20px auto 0;
    border-radius: 2px;
}

/* Blog Grid */
.blog-section {
    padding: 80px 0;
    background: #f8fafc;
}
.blog-card {
    background: #ffffff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.06);
    transition: transform 0.3s, box-shadow 0.3s;
    height: 100%;
    display: flex;
    flex-direction: column;
    text-decoration: none;
    color: inherit;
}
.blog-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 30px rgba(0,56,147,0.12);
}
.blog-img-wrap {
    width: 100%;
    height: 220px;
    overflow: hidden;
    position: relative;
    background: #e2e8f0;
}
.blog-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s;
}
.blog-card:hover .blog-img-wrap img {
    transform: scale(1.08);
}
.blog-date-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(0,56,147,0.9);
    color: #FECB00;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 700;
    backdrop-filter: blur(4px);
}
.blog-content {
    padding: 25px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}
.blog-title {
    font-family: 'Mukta', 'Noto Sans Devanagari', sans-serif;
    font-size: 1.25rem;
    font-weight: 700;
    color: #003893;
    margin-bottom: 15px;
    line-height: 1.4;
}
.blog-excerpt {
    font-size: 0.95rem;
    color: #4a5568;
    line-height: 1.6;
    margin-bottom: 20px;
    flex-grow: 1;
}
.blog-readmore {
    font-size: 0.9rem;
    font-weight: 700;
    color: #D21034;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.blog-card:hover .blog-readmore {
    color: #003893;
}
</style>

<!-- Hero Section -->
<section class="blog-hero">
    <div class="container">
        <h1 class="blog-hero-title" data-hi="दैनिक विचार एवं ब्लॉग" data-en="Daily Thoughts & Blog">दैनिक विचार एवं ब्लॉग</h1>
        <p class="blog-hero-subtitle" data-hi="श्री दद्दू प्रसाद जी के नवीनतम विचार, लेख और सामाजिक न्याय पर दृष्टिकोण।" data-en="Latest thoughts, articles, and perspectives on social justice by Shri Daddoo Prasad.">
            श्री दद्दू प्रसाद जी के नवीनतम विचार, लेख और सामाजिक न्याय पर दृष्टिकोण।
        </p>
        <div class="blog-hero-rule"></div>
    </div>
</section>

<!-- Blog Grid Section -->
<section class="blog-section">
    <div class="container">
        <div class="row g-4">
            <?php 
            $fallbackImgs = [
                'https://images.unsplash.com/photo-1543269865-cbf427effbad?w=600&q=80',
                'https://images.unsplash.com/photo-1555848962-6e79363ec58f?w=600&q=80',
                'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=600&q=80',
                'https://images.unsplash.com/photo-1517048676732-d65bc937f952?w=600&q=80'
            ];
            foreach ($blogs as $idx => $post): 
                $title   = $post['title_' . $lang] ?? $post['title_hi'];
                $content = $post['content_' . $lang] ?? $post['content_hi'];
                $imgUrl  = (!empty($post['image_url'])) ? $post['image_url'] : $fallbackImgs[$idx % 4];
                $excerpt = mb_substr(strip_tags($content), 0, 150) . '...';
            ?>
            <div class="col-lg-4 col-md-6">
                <a href="blog_detail.php?id=<?= $post['id'] ?>" class="blog-card">
                    <div class="blog-img-wrap">
                        <img src="<?= htmlspecialchars(strpos($imgUrl, 'http') === 0 ? $imgUrl : $imgUrl) ?>" alt="<?= htmlspecialchars($title) ?>">
                        <div class="blog-date-badge">
                            <i class="far fa-calendar-alt"></i> <?= date('d M, Y', strtotime($post['publish_date'])) ?>
                        </div>
                    </div>
                    <div class="blog-content">
                        <h3 class="blog-title"><?= htmlspecialchars($title) ?></h3>
                        <p class="blog-excerpt"><?= htmlspecialchars($excerpt) ?></p>
                        <div class="blog-readmore" data-hi="पूरा पढ़ें &rarr;" data-en="Read More &rarr;">पूरा पढ़ें &rarr;</div>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>

            <?php if (empty($blogs)): ?>
                <div class="col-12 text-center py-5">
                    <h4 class="text-muted" data-hi="अभी कोई ब्लॉग पोस्ट उपलब्ध नहीं है।" data-en="No blog posts available yet.">अभी कोई ब्लॉग पोस्ट उपलब्ध नहीं है।</h4>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
