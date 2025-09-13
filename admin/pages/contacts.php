<?php
require_once __DIR__ . '/../config/database.php';

$database = new Database();
$db = $database->getConnection();

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'mark_read':
                $message_id = (int)$_POST['message_id'];
                $stmt = $db->prepare("UPDATE contact_messages SET status = 'read', read_at = NOW() WHERE id = ?");
                $stmt->execute([$message_id]);
                logActivity($_SESSION['admin_id'], 'message_read', "Marked message ID $message_id as read");
                break;
                
            case 'reply_message':
                $message_id = (int)$_POST['message_id'];
                $reply = sanitizeInput($_POST['reply']);
                $stmt = $db->prepare("UPDATE contact_messages SET admin_reply = ?, status = 'replied', replied_at = NOW(), replied_by = ? WHERE id = ?");
                $stmt->execute([$reply, $_SESSION['admin_id'], $message_id]);
                logActivity($_SESSION['admin_id'], 'message_reply', "Replied to message ID $message_id");
                break;
                
            case 'update_contact_info':
                $phone = sanitizeInput($_POST['phone']);
                $email = sanitizeInput($_POST['email']);
                $address = sanitizeInput($_POST['address']);
                $office_hours = sanitizeInput($_POST['office_hours']);
                $whatsapp = sanitizeInput($_POST['whatsapp']);
                $instagram = sanitizeInput($_POST['instagram']);
                $facebook = sanitizeInput($_POST['facebook']);
                
                $stmt = $db->prepare("UPDATE contact_info SET phone = ?, email = ?, address = ?, office_hours = ?, whatsapp = ?, instagram = ?, facebook = ?, updated_at = NOW() WHERE id = 1");
                $stmt->execute([$phone, $email, $address, $office_hours, $whatsapp, $instagram, $facebook]);
                logActivity($_SESSION['admin_id'], 'contact_update', "Updated contact information");
                break;
        }
    }
}

// Get contact messages
$messages_query = "SELECT cm.*, au.full_name as replied_by_name 
                   FROM contact_messages cm 
                   LEFT JOIN admin_users au ON cm.replied_by = au.id 
                   ORDER BY cm.created_at DESC";
$messages_stmt = $db->prepare($messages_query);
$messages_stmt->execute();
$messages = $messages_stmt->fetchAll();

// Get contact info
$contact_query = "SELECT * FROM contact_info WHERE id = 1";
$contact_stmt = $db->prepare($contact_query);
$contact_stmt->execute();
$contact_info = $contact_stmt->fetch();
?>

<style>
.contacts-container {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 30px;
    margin-bottom: 30px;
}

.messages-section, .contact-info-section {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    border: 1px solid #e2e8f0;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #f1f5f9;
}

.section-title {
    font-size: 20px;
    font-weight: 600;
    color: #2d3748;
}

.message-card {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 15px;
    transition: all 0.3s ease;
}

.message-card:hover {
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.message-card.unread {
    border-left: 4px solid #4a89dc;
    background: #f0f8ff;
}

.message-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 10px;
}

.message-sender {
    font-weight: 600;
    color: #2d3748;
    font-size: 16px;
}

.message-date {
    font-size: 12px;
    color: #718096;
}

.message-status {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
}

.status-unread { background: #fef5e7; color: #d69e2e; }
.status-read { background: #e6fffa; color: #319795; }
.status-replied { background: #f0fff4; color: #38a169; }

.message-content {
    color: #4a5568;
    line-height: 1.6;
    margin-bottom: 15px;
}

.message-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.btn {
    padding: 8px 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 12px;
    font-weight: 500;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.btn-primary { background: #4a89dc; color: white; }
.btn-success { background: #38a169; color: white; }
.btn-secondary { background: #718096; color: white; }

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.reply-form {
    margin-top: 15px;
    padding: 15px;
    background: white;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
}

.form-group {
    margin-bottom: 15px;
}

.form-label {
    display: block;
    margin-bottom: 5px;
    font-weight: 500;
    color: #2d3748;
}

.form-input, .form-textarea {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    font-size: 14px;
    transition: border-color 0.3s ease;
}

.form-input:focus, .form-textarea:focus {
    outline: none;
    border-color: #4a89dc;
    box-shadow: 0 0 0 3px rgba(74, 137, 220, 0.1);
}

.form-textarea {
    resize: vertical;
    min-height: 80px;
}

.contact-info-form .form-input {
    margin-bottom: 10px;
}

.stats-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    margin-bottom: 20px;
}

.stat-box {
    background: #f8fafc;
    padding: 15px;
    border-radius: 10px;
    text-align: center;
    border: 1px solid #e2e8f0;
}

.stat-number {
    font-size: 24px;
    font-weight: 700;
    color: #2d3748;
}

.stat-label {
    font-size: 12px;
    color: #718096;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

@media (max-width: 1024px) {
    .contacts-container {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="contacts-container">
    <!-- Messages Section -->
    <div class="messages-section">
        <div class="section-header">
            <h2 class="section-title">Pesan Kontak</h2>
        </div>

        <?php
        // Calculate stats
        $total_messages = count($messages);
        $unread_count = count(array_filter($messages, function($m) { return $m['status'] === 'unread'; }));
        $replied_count = count(array_filter($messages, function($m) { return $m['status'] === 'replied'; }));
        ?>

        <div class="stats-row">
            <div class="stat-box">
                <div class="stat-number"><?php echo $total_messages; ?></div>
                <div class="stat-label">Total Pesan</div>
            </div>
            <div class="stat-box">
                <div class="stat-number"><?php echo $unread_count; ?></div>
                <div class="stat-label">Belum Dibaca</div>
            </div>
            <div class="stat-box">
                <div class="stat-number"><?php echo $replied_count; ?></div>
                <div class="stat-label">Sudah Dibalas</div>
            </div>
        </div>

        <div class="messages-list">
            <?php if (empty($messages)): ?>
                <div style="text-align: center; padding: 40px; color: #718096;">
                    <i class="fas fa-inbox" style="font-size: 48px; margin-bottom: 15px; opacity: 0.5;"></i>
                    <p>Belum ada pesan masuk</p>
                </div>
            <?php else: ?>
                <?php foreach ($messages as $message): ?>
                    <div class="message-card <?php echo $message['status'] === 'unread' ? 'unread' : ''; ?>">
                        <div class="message-header">
                            <div>
                                <div class="message-sender"><?php echo htmlspecialchars($message['name']); ?></div>
                                <div style="font-size: 14px; color: #718096; margin-top: 2px;">
                                    <?php echo htmlspecialchars($message['email']); ?> • 
                                    <?php echo htmlspecialchars($message['phone']); ?>
                                </div>
                            </div>
                            <div style="text-align: right;">
                                <div class="message-date"><?php echo date('d M Y, H:i', strtotime($message['created_at'])); ?></div>
                                <span class="message-status status-<?php echo $message['status']; ?>">
                                    <?php echo ucfirst($message['status']); ?>
                                </span>
                            </div>
                        </div>

                        <div class="message-content">
                            <?php echo nl2br(htmlspecialchars($message['message'])); ?>
                        </div>

                        <?php if ($message['admin_reply']): ?>
                            <div style="background: #f0fff4; padding: 15px; border-radius: 8px; margin-top: 15px; border-left: 4px solid #38a169;">
                                <strong>Balasan Admin:</strong><br>
                                <?php echo nl2br(htmlspecialchars($message['admin_reply'])); ?>
                                <div style="font-size: 12px; color: #718096; margin-top: 8px;">
                                    Dibalas oleh <?php echo htmlspecialchars($message['replied_by_name']); ?> 
                                    pada <?php echo date('d M Y, H:i', strtotime($message['replied_at'])); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="message-actions">
                            <?php if ($message['status'] === 'unread'): ?>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="action" value="mark_read">
                                    <input type="hidden" name="message_id" value="<?php echo $message['id']; ?>">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-eye"></i> Tandai Dibaca
                                    </button>
                                </form>
                            <?php endif; ?>

                            <?php if (!$message['admin_reply']): ?>
                                <button onclick="toggleReplyForm(<?php echo $message['id']; ?>)" class="btn btn-success">
                                    <i class="fas fa-reply"></i> Balas
                                </button>
                            <?php endif; ?>
                        </div>

                        <?php if (!$message['admin_reply']): ?>
                            <div id="reply-form-<?php echo $message['id']; ?>" class="reply-form" style="display: none;">
                                <form method="POST">
                                    <input type="hidden" name="action" value="reply_message">
                                    <input type="hidden" name="message_id" value="<?php echo $message['id']; ?>">
                                    <div class="form-group">
                                        <label class="form-label">Balasan:</label>
                                        <textarea name="reply" class="form-textarea" placeholder="Tulis balasan Anda..." required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success">Kirim Balasan</button>
                                    <button type="button" onclick="toggleReplyForm(<?php echo $message['id']; ?>)" class="btn btn-secondary">Batal</button>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Contact Info Section -->
    <div class="contact-info-section">
        <div class="section-header">
            <h2 class="section-title">Informasi Kontak</h2>
        </div>

        <form method="POST" class="contact-info-form">
            <input type="hidden" name="action" value="update_contact_info">
            
            <div class="form-group">
                <label class="form-label">Nomor Telepon</label>
                <input type="text" name="phone" class="form-input" value="<?php echo htmlspecialchars($contact_info['phone'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-input" value="<?php echo htmlspecialchars($contact_info['email'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label class="form-label">Alamat</label>
                <textarea name="address" class="form-textarea" required><?php echo htmlspecialchars($contact_info['address'] ?? ''); ?></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Jam Operasional</label>
                <input type="text" name="office_hours" class="form-input" value="<?php echo htmlspecialchars($contact_info['office_hours'] ?? ''); ?>" placeholder="Senin - Jumat: 08:00 - 17:00">
            </div>

            <div class="form-group">
                <label class="form-label">WhatsApp</label>
                <input type="text" name="whatsapp" class="form-input" value="<?php echo htmlspecialchars($contact_info['whatsapp'] ?? ''); ?>" placeholder="628123456789">
            </div>

            <div class="form-group">
                <label class="form-label">Instagram</label>
                <input type="text" name="instagram" class="form-input" value="<?php echo htmlspecialchars($contact_info['instagram'] ?? ''); ?>" placeholder="@rentiva_official">
            </div>

            <div class="form-group">
                <label class="form-label">Facebook</label>
                <input type="text" name="facebook" class="form-input" value="<?php echo htmlspecialchars($contact_info['facebook'] ?? ''); ?>" placeholder="Rentiva Official">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
        </form>
    </div>
</div>

<script>
function toggleReplyForm(messageId) {
    const form = document.getElementById('reply-form-' + messageId);
    if (form.style.display === 'none') {
        form.style.display = 'block';
        form.querySelector('textarea').focus();
    } else {
        form.style.display = 'none';
    }
}
</script>
