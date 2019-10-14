<?php

namespace Traits\Model\User;

trait Signature
{
    public function getShortSignature(): string
    {
        $max_signature_len = 70;

        $short_signature = $this->signature;
        if (mb_strlen($this->signature) > $max_signature_len) {
            $short_signature = mb_substr($this->signature, 0, $max_signature_len) . '&hellip;';
        }

        return $short_signature;
    }
}
