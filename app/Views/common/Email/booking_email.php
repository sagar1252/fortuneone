<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Appointment Confirmed</title>
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
                    <?= isset($is_user) && $is_user ? 'Appointment Confirmed' : 'New Meeting Request' ?>
                </h1>
                <div style="height: 2px; width: 60px; background-color: #9E693D; margin: 20px auto 0 auto;"></div>
            </td>
        </tr>

        <!-- Body Area -->
        <tr>
            <td style="padding: 10px 40px 40px 40px; font-family: 'Arial', sans-serif;">
                <p style="margin-top: 0; margin-bottom: 30px; font-size: 15px; line-height: 1.6; color: #555555; text-align: center;">
                    <?= isset($is_user) && $is_user ? 'Thank you for choosing Fortune One. Your meeting has been scheduled. Below are the details of your appointment:' : 'A new meeting request has been submitted via the Fortune One portal. Below are the details:' ?>
                </p>
                
                <table width="100%" cellpadding="15" cellspacing="0" border="0" style="border-collapse: collapse; background-color: #FAFAF8; border: 1px solid #eeeeee; border-radius: 8px;">
                    <tr>
                        <td style="border-bottom: 1px solid #e5e5e5; width: 40%; color: #9E693D; font-weight: bold; text-transform: uppercase; font-size: 12px; letter-spacing: 1px;">Full Name</td>
                        <td style="border-bottom: 1px solid #e5e5e5; color: #1A2530; font-size: 15px; font-weight: bold;"><?= esc($full_name) ?></td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 1px solid #e5e5e5; color: #9E693D; font-weight: bold; text-transform: uppercase; font-size: 12px; letter-spacing: 1px;">Email Address</td>
                        <td style="border-bottom: 1px solid #e5e5e5;"><a href="mailto:<?= esc($email) ?>" style="color: #1A2530; text-decoration: none; font-size: 15px; font-weight: bold;"><?= esc($email) ?></a></td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 1px solid #e5e5e5; color: #9E693D; font-weight: bold; text-transform: uppercase; font-size: 12px; letter-spacing: 1px;">Phone Number</td>
                        <td style="border-bottom: 1px solid #e5e5e5; color: #1A2530; font-size: 15px; font-weight: bold;"><?= esc($phone ?? 'Not provided') ?></td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 1px solid #e5e5e5; color: #9E693D; font-weight: bold; text-transform: uppercase; font-size: 12px; letter-spacing: 1px;">Date</td>
                        <td style="border-bottom: 1px solid #e5e5e5; color: #1A2530; font-size: 15px; font-weight: bold;"><?= esc($selected_date) ?></td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 1px solid #e5e5e5; color: #9E693D; font-weight: bold; text-transform: uppercase; font-size: 12px; letter-spacing: 1px;">Time</td>
                        <td style="border-bottom: 1px solid #e5e5e5; color: #1A2530; font-size: 15px; font-weight: bold;"><?= esc($selected_time) ?></td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 1px solid #e5e5e5; color: #9E693D; font-weight: bold; text-transform: uppercase; font-size: 12px; letter-spacing: 1px;">Meeting Link</td>
                        <td style="border-bottom: 1px solid #e5e5e5;">
                            <a href="https://meet.google.com/zkr-hfzf-tuo" style="display: inline-block; padding: 10px 18px; background-color: #1A2530; color: #ffffff; text-decoration: none; border-radius: 4px; font-size: 13px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">Join Google Meet</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #9E693D; font-weight: bold; text-transform: uppercase; font-size: 12px; letter-spacing: 1px; vertical-align: top;">Message</td>
                        <td style="color: #555555; font-size: 14px; line-height: 1.6;"><?= nl2br(esc($message ?? 'No message provided')) ?></td>
                    </tr>
                </table>
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
