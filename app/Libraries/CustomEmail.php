<?php

namespace App\Libraries;

use CodeIgniter\Email\Email;

class CustomEmail extends Email
{
    /**
     * Overridden SMTP connection to use stream_socket_client with context options,
     * allowing peer verification to be disabled for local development on XAMPP.
     *
     * @return bool|string
     */
    protected function SMTPConnect()
    {
        if ($this->isSMTPConnected()) {
            return true;
        }

        $ssl = '';

        // Connection to port 465 should use implicit TLS (without STARTTLS)
        // as per RFC 8314.
        if ($this->SMTPPort === 465) {
            $ssl = 'tls://';
        }
        // But if $SMTPCrypto is set to `ssl`, SSL can be used.
        if ($this->SMTPCrypto === 'ssl') {
            $ssl = 'ssl://';
        }

        // Bypassing SSL verification for local XAMPP environments
        $context = stream_context_create([
            'ssl' => [
                'verify_peer'       => false,
                'verify_peer_name'  => false,
                'allow_self_signed' => true,
            ]
        ]);

        // Use stream_socket_client to allow using a stream context
        $this->SMTPConnect = @stream_socket_client(
            $ssl . $this->SMTPHost . ':' . $this->SMTPPort,
            $errno,
            $errstr,
            $this->SMTPTimeout,
            STREAM_CLIENT_CONNECT,
            $context
        );

        if (! $this->isSMTPConnected()) {
            $this->setErrorMessage(lang('Email.SMTPError', [$errno . ' ' . $errstr]));

            return false;
        }

        stream_set_timeout($this->SMTPConnect, $this->SMTPTimeout);
        $this->setErrorMessage($this->getSMTPData());

        if ($this->SMTPCrypto === 'tls') {
            $this->sendCommand('hello');
            $this->sendCommand('starttls');
            
            $crypto = stream_socket_enable_crypto(
                $this->SMTPConnect,
                true,
                STREAM_CRYPTO_METHOD_TLSv1_0_CLIENT
                | STREAM_CRYPTO_METHOD_TLSv1_1_CLIENT
                | STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT
                | STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT,
            );

            if ($crypto !== true) {
                $this->setErrorMessage(lang('Email.SMTPError', [$this->getSMTPData()]));

                return false;
            }
        }

        return $this->sendCommand('hello');
    }
}
