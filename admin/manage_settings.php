<?php
require_once 'includes/header.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $pdo->beginTransaction();
        
        $settings = [
            'hero_tagline', 'hero_intro', 'about_lead', 'about_desc', 
            'contact_address', 'contact_phone', 'contact_email', 'contact_hours',
            'fb_link', 'twitter_link', 'yt_link', 'ig_link'
        ];

        $stmt = $pdo->prepare("INSERT INTO settings (setting_key, value_hi, value_en) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE value_hi = VALUES(value_hi), value_en = VALUES(value_en)");

        foreach ($settings as $key) {
            $val_hi = $_POST[$key . '_hi'] ?? '';
            $val_en = $_POST[$key . '_en'] ?? '';
            $stmt->execute([$key, $val_hi, $val_en]);
        }

        $pdo->commit();
        $_SESSION['success'] = "Settings updated successfully.";
    } catch (Exception $e) {
        $pdo->rollBack();
        $_SESSION['error'] = "Error updating settings: " . $e->getMessage();
    }
    
    // Redirect to prevent form resubmission
    header("Location: manage_settings.php");
    exit;
}

// Fetch all current settings
$stmt = $pdo->query("SELECT * FROM settings");
$currentSettings = [];
while ($row = $stmt->fetch()) {
    $currentSettings[$row['setting_key']] = $row;
}

function getVal($array, $key, $lang) {
    return htmlspecialchars($array[$key]["value_$lang"] ?? '');
}
?>

<div class="container-fluid">
    <h2 class="mb-4 text-blue">Global Settings</h2>

    <form method="POST" action="">
        <!-- Hero Section Settings -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header bg-white">
                <h5 class="mb-0 text-orange"><i class="fas fa-home me-2"></i> Hero Section</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-muted">Hindi (हिंदी)</h6>
                        <div class="mb-3">
                            <label class="form-label">Tagline (Main Heading)</label>
                            <input type="text" class="form-control" name="hero_tagline_hi" value="<?= getVal($currentSettings, 'hero_tagline', 'hi') ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Hero Intro (Subtext)</label>
                            <textarea class="form-control" name="hero_intro_hi" rows="3"><?= getVal($currentSettings, 'hero_intro', 'hi') ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">English</h6>
                        <div class="mb-3">
                            <label class="form-label">Tagline (Main Heading)</label>
                            <input type="text" class="form-control" name="hero_tagline_en" value="<?= getVal($currentSettings, 'hero_tagline', 'en') ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Hero Intro (Subtext)</label>
                            <textarea class="form-control" name="hero_intro_en" rows="3"><?= getVal($currentSettings, 'hero_intro', 'en') ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- About Section Settings -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header bg-white">
                <h5 class="mb-0 text-orange"><i class="fas fa-info-circle me-2"></i> About Section</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-muted">Hindi (हिंदी)</h6>
                        <div class="mb-3">
                            <label class="form-label">Lead Text</label>
                            <textarea class="form-control" name="about_lead_hi" rows="2"><?= getVal($currentSettings, 'about_lead', 'hi') ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description Text</label>
                            <textarea class="form-control" name="about_desc_hi" rows="3"><?= getVal($currentSettings, 'about_desc', 'hi') ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">English</h6>
                        <div class="mb-3">
                            <label class="form-label">Lead Text</label>
                            <textarea class="form-control" name="about_lead_en" rows="2"><?= getVal($currentSettings, 'about_lead', 'en') ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description Text</label>
                            <textarea class="form-control" name="about_desc_en" rows="3"><?= getVal($currentSettings, 'about_desc', 'en') ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Section Settings -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header bg-white">
                <h5 class="mb-0 text-orange"><i class="fas fa-address-book me-2"></i> Contact Details</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-muted">Hindi (हिंदी)</h6>
                        <div class="mb-3"><label class="form-label">Address</label><input type="text" class="form-control" name="contact_address_hi" value="<?= getVal($currentSettings, 'contact_address', 'hi') ?>"></div>
                        <div class="mb-3"><label class="form-label">Phone</label><input type="text" class="form-control" name="contact_phone_hi" value="<?= getVal($currentSettings, 'contact_phone', 'hi') ?>"></div>
                        <div class="mb-3"><label class="form-label">Email</label><input type="text" class="form-control" name="contact_email_hi" value="<?= getVal($currentSettings, 'contact_email', 'hi') ?>"></div>
                        <div class="mb-3"><label class="form-label">Working Hours</label><input type="text" class="form-control" name="contact_hours_hi" value="<?= getVal($currentSettings, 'contact_hours', 'hi') ?>"></div>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">English</h6>
                        <div class="mb-3"><label class="form-label">Address</label><input type="text" class="form-control" name="contact_address_en" value="<?= getVal($currentSettings, 'contact_address', 'en') ?>"></div>
                        <div class="mb-3"><label class="form-label">Phone</label><input type="text" class="form-control" name="contact_phone_en" value="<?= getVal($currentSettings, 'contact_phone', 'en') ?>"></div>
                        <div class="mb-3"><label class="form-label">Email</label><input type="text" class="form-control" name="contact_email_en" value="<?= getVal($currentSettings, 'contact_email', 'en') ?>"></div>
                        <div class="mb-3"><label class="form-label">Working Hours</label><input type="text" class="form-control" name="contact_hours_en" value="<?= getVal($currentSettings, 'contact_hours', 'en') ?>"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Social Media Settings -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header bg-white">
                <h5 class="mb-0 text-orange"><i class="fas fa-share-alt me-2"></i> Social Media Links</h5>
            </div>
            <div class="card-body">
                <p class="text-muted small mb-3">These links are the same for both languages.</p>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fab fa-facebook text-primary me-1"></i> Facebook</label>
                        <input type="url" class="form-control" name="fb_link_en" value="<?= getVal($currentSettings, 'fb_link', 'en') ?>" placeholder="https://facebook.com/...">
                        <!-- Also fill Hindi field silently to match DB logic -->
                        <input type="hidden" name="fb_link_hi" value="<?= getVal($currentSettings, 'fb_link', 'en') ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fab fa-twitter text-info me-1"></i> Twitter / X</label>
                        <input type="url" class="form-control" name="twitter_link_en" value="<?= getVal($currentSettings, 'twitter_link', 'en') ?>" placeholder="https://twitter.com/...">
                        <input type="hidden" name="twitter_link_hi" value="<?= getVal($currentSettings, 'twitter_link', 'en') ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fab fa-instagram text-danger me-1"></i> Instagram</label>
                        <input type="url" class="form-control" name="ig_link_en" value="<?= getVal($currentSettings, 'ig_link', 'en') ?>" placeholder="https://instagram.com/...">
                        <input type="hidden" name="ig_link_hi" value="<?= getVal($currentSettings, 'ig_link', 'en') ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fab fa-youtube text-danger me-1"></i> YouTube</label>
                        <input type="url" class="form-control" name="yt_link_en" value="<?= getVal($currentSettings, 'yt_link', 'en') ?>" placeholder="https://youtube.com/...">
                        <input type="hidden" name="yt_link_hi" value="<?= getVal($currentSettings, 'yt_link', 'en') ?>">
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-5 pb-5">
            <button type="submit" class="btn btn-primary btn-lg" style="background: #003893"><i class="fas fa-save me-2"></i> Save All Settings</button>
        </div>
    </form>
</div>

<?php require_once 'includes/footer.php'; ?>
