<?php
require_once 'includes/header.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $pdo->prepare("SELECT * FROM blog_posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();

if (!$post) {
    echo "<div class='container py-5 text-center'><h3>Blog post not found.</h3><a href='blog.php' class='btn btn-primary mt-3'>Return to Blog</a></div>";
    require_once 'includes/footer.php';
    exit;
}

$lang = $_COOKIE['lang'] ?? 'hi';
$title = $post['title_' . $lang] ?? $post['title_hi'];
$content = $post['content_' . $lang] ?? $post['content_hi'];

// If no direct image URL, use a placeholder
$imgUrl = $post['image_url'];
if (empty($imgUrl)) {
    $imgUrl = 'https://images.unsplash.com/photo-1543269865-cbf427effbad?w=1200&q=80';
} elseif (strpos($imgUrl, 'http') !== 0) {
    $imgUrl = $imgUrl; // Local image
}
?>
<style>
/* Blog Detail Layout */
.blog-detail-bg {
    background: #f8fafc;
    padding: 60px 0 80px;
}
.blog-article {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.05);
    overflow: hidden;
    max-width: 900px;
    margin: 0 auto;
}
.blog-hero-img {
    width: 100%;
    height: 450px;
    object-fit: cover;
    display: block;
}
.blog-article-body {
    padding: 50px;
}
.blog-meta {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 25px;
    border-bottom: 1px solid #e2e8f0;
    padding-bottom: 20px;
}
.blog-meta-item {
    font-size: 0.95rem;
    color: #4a5568;
    font-weight: 600;
}
.blog-meta-item i {
    color: #D21034;
    margin-right: 6px;
}
.blog-detail-title {
    font-family: 'Mukta', 'Noto Sans Devanagari', sans-serif;
    font-size: 2.4rem;
    font-weight: 800;
    color: #003893;
    line-height: 1.3;
    margin-bottom: 30px;
}
.blog-detail-content {
    font-size: 1.05rem;
    color: #2d3748;
    line-height: 1.85;
}
.blog-detail-content p {
    margin-bottom: 20px;
}
.blog-detail-content img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 20px 0;
}
.back-btn-wrap {
    max-width: 900px;
    margin: 0 auto 30px;
}
.back-to-blog {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #003893;
    font-weight: 700;
    text-decoration: none;
    font-size: 0.95rem;
    transition: color 0.2s;
}
.back-to-blog:hover {
    color: #D21034;
}

@media (max-width: 768px) {
    .blog-hero-img { height: 300px; }
    .blog-article-body { padding: 30px 20px; }
    .blog-detail-title { font-size: 1.8rem; }
}
</style>

<section class="blog-detail-bg">
    <div class="container">
        
        <div class="back-btn-wrap">
            <a href="blog.php" class="back-to-blog">
                <i class="fas fa-arrow-left"></i> <span data-hi="सभी ब्लॉग पर लौटें" data-en="Back to all blogs">सभी ब्लॉग पर लौटें</span>
            </a>
        </div>

        <article class="blog-article">
            <img src="<?= htmlspecialchars($imgUrl) ?>" alt="<?= htmlspecialchars($title) ?>" class="blog-hero-img">
            
            <div class="blog-article-body">
                <div class="blog-meta">
                    <span class="blog-meta-item">
                        <i class="far fa-calendar-alt"></i> <?= date('d M Y', strtotime($post['publish_date'])) ?>
                    </span>
                    <span class="blog-meta-item">
                        <i class="fas fa-user-circle"></i> <span data-hi="दद्दू प्रसाद" data-en="Daddoo Prasad">दद्दू प्रसाद</span>
                    </span>
                </div>

                <h1 class="blog-detail-title"><?= htmlspecialchars($title) ?></h1>
                
                <div class="blog-detail-content">
                    <?= nl2br(htmlspecialchars($content)) ?>
                </div>
            </div>
        </article>
        
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
