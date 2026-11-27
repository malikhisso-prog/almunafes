
<?php
declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Flash Messages
|--------------------------------------------------------------------------
*/

$successMessage = $_SESSION['form_success'] ?? null;
$formErrors = $_SESSION['form_errors'] ?? [];

// حذف الرسائل بعد قراءتها حتى لا تظهر مجدداً عند تحديث الصفحة
unset($_SESSION['form_success'], $_SESSION['form_errors']);

?>

<?php if (is_string($successMessage) && $successMessage !== ''): ?>

    <div class="flash-message flash-success" role="status">

        <span class="flash-icon">✓</span>

        <p><?= e($successMessage) ?></p>

    </div>

<?php endif; ?>


<?php if (is_array($formErrors) && !empty($formErrors)): ?>

    <div class="flash-message flash-error" role="alert">

        <span class="flash-icon">!</span>

        <div>

            <strong>يرجى مراجعة البيانات التالية:</strong>

            <ul>
                <?php foreach ($formErrors as $error): ?>

                    <?php if (is_string($error)): ?>

                        <li><?= e($error) ?></li>

                    <?php endif; ?>

                <?php endforeach; ?>
            </ul>

        </div>

    </div>

<?php endif; ?>
