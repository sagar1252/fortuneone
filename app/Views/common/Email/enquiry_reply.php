<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Thank You for Your Enquiry</title>
</head>
<body style="margin: 0; padding: 30px 10px; font-family: 'Georgia', serif; background-color: #F5F3F0; color: #1A2530;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.05);">
        
        <!-- Logo Area -->
        <tr>
            <td style="padding: 40px 20px 10px 20px; text-align: center; background-color: #ffffff;">
                <img src="<?= base_url('assets/website/images/logo.png') ?>" alt="Fortune One" style="max-height: 70px; height: auto;">
            </td>
        </tr>

        <!-- Header Area -->
        <tr>
            <td style="padding: 10px 40px 30px 40px; text-align: center; background-color: #ffffff;">
                <h1 style="color: #1A2530; margin: 0; font-size: 32px; font-weight: normal; letter-spacing: 1px;">
                    Thank You
                </h1>
                <div style="height: 2px; width: 60px; background-color: #9E693D; margin: 20px auto 0 auto;"></div>
            </td>
        </tr>

        <!-- Body Area -->
        <tr>
            <td style="padding: 10px 40px 40px 40px; font-family: 'Arial', sans-serif;">
                <p style="margin-top: 0; margin-bottom: 25px; font-size: 16px; line-height: 1.6; color: #1A2530;">
                    Dear <strong><?= esc($name ?? 'Guest') ?></strong>,
                </p>
                <p style="margin-top: 0; margin-bottom: 30px; font-size: 15px; line-height: 1.8; color: #555555;">
                    <?= isset($custom_message) ? $custom_message : 'We have successfully received your enquiry. The Fortune One team will connect with you shortly.' ?>
                </p>
                
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td align="center">
                            <a href="<?= base_url() ?>" style="display: inline-block; padding: 12px 30px; background-color: #1A2530; color: #ffffff; text-decoration: none; border-radius: 4px; font-size: 13px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">Visit Our Website</a>
                        </td>
                    </tr>
                </table>
                
                <p style="margin-top: 40px; margin-bottom: 0; font-size: 15px; line-height: 1.6; color: #555555;">
                    Best Regards,<br>
                    <strong>Fortune One Team</strong>
                </p>
            </td>
        </tr>
        
        <!-- Footer Area -->
        <tr>
            <td style="background-color: #1A2530; padding: 30px; text-align: center; color: #D4A574; font-size: 12px; letter-spacing: 2px;">
                <p style="margin: 0; text-transform: uppercase; font-weight: bold;">Fortune One Group</p>
                <p style="margin: 8px 0 0 0; opacity: 0.7; color: #ffffff; font-family: 'Georgia', serif; letter-spacing: 0; font-style: italic;">Where Vision Creates Legacy</p>
            </td>
        </tr>
    </table>
</body>
</html>
