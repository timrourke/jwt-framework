<?php

declare(strict_types=1);

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2018 Spomky-Labs
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace Jose\Component\Encryption\Tests\RFC7520;

use Base64Url\Base64Url;
use Jose\Component\Core\JWK;
use Jose\Component\Encryption\Tests\EncryptionTest;

/**
 * @see https://tools.ietf.org/html/rfc7520#section-5.13
 *
 * @group RFC7520
 */
final class MultipleRecipientEncryptionTest extends EncryptionTest
{
    /**
     * Please note that we cannot the encryption and get the same result as the example (IV, TAG and other data are always different).
     * The output given in the RFC is used and only decrypted.
     */
    public function testMultipleRecipientEncryption()
    {
        $expected_payload = "You can trust us to stick with you through thick and thin\xe2\x80\x93to the bitter end. And you can trust us to keep any secret of yours\xe2\x80\x93closer than you keep it yourself. But you cannot trust us to let you face trouble alone, and go off without a word. We are your friends, Frodo.";

        $recipient_1_private_key = JWK::create([
            'kty' => 'RSA',
            'kid' => 'frodo.baggins@hobbiton.example',
            'use' => 'enc',
            'n'   => 'maxhbsmBtdQ3CNrKvprUE6n9lYcregDMLYNeTAWcLj8NnPU9XIYegTHVHQjxKDSHP2l-F5jS7sppG1wgdAqZyhnWvXhYNvcM7RfgKxqNx_xAHx6f3yy7s-M9PSNCwPC2lh6UAkR4I00EhV9lrypM9Pi4lBUop9t5fS9W5UNwaAllhrd-osQGPjIeI1deHTwx-ZTHu3C60Pu_LJIl6hKn9wbwaUmA4cR5Bd2pgbaY7ASgsjCUbtYJaNIHSoHXprUdJZKUMAzV0WOKPfA6OPI4oypBadjvMZ4ZAj3BnXaSYsEZhaueTXvZB4eZOAjIyh2e_VOIKVMsnDrJYAVotGlvMQ',
            'e'   => 'AQAB',
            'd'   => 'Kn9tgoHfiTVi8uPu5b9TnwyHwG5dK6RE0uFdlpCGnJN7ZEi963R7wybQ1PLAHmpIbNTztfrheoAniRV1NCIqXaW_qS461xiDTp4ntEPnqcKsyO5jMAji7-CL8vhpYYowNFvIesgMoVaPRYMYT9TW63hNM0aWs7USZ_hLg6Oe1mY0vHTI3FucjSM86Nff4oIENt43r2fspgEPGRrdE6fpLc9Oaq-qeP1GFULimrRdndm-P8q8kvN3KHlNAtEgrQAgTTgz80S-3VD0FgWfgnb1PNmiuPUxO8OpI9KDIfu_acc6fg14nsNaJqXe6RESvhGPH2afjHqSy_Fd2vpzj85bQQ',
            'p'   => '2DwQmZ43FoTnQ8IkUj3BmKRf5Eh2mizZA5xEJ2MinUE3sdTYKSLtaEoekX9vbBZuWxHdVhM6UnKCJ_2iNk8Z0ayLYHL0_G21aXf9-unynEpUsH7HHTklLpYAzOOx1ZgVljoxAdWNn3hiEFrjZLZGS7lOH-a3QQlDDQoJOJ2VFmU',
            'q'   => 'te8LY4-W7IyaqH1ExujjMqkTAlTeRbv0VLQnfLY2xINnrWdwiQ93_VF099aP1ESeLja2nw-6iKIe-qT7mtCPozKfVtUYfz5HrJ_XY2kfexJINb9lhZHMv5p1skZpeIS-GPHCC6gRlKo1q-idn_qxyusfWv7WAxlSVfQfk8d6Et0',
            'dp'  => 'UfYKcL_or492vVc0PzwLSplbg4L3-Z5wL48mwiswbpzOyIgd2xHTHQmjJpFAIZ8q-zf9RmgJXkDrFs9rkdxPtAsL1WYdeCT5c125Fkdg317JVRDo1inX7x2Kdh8ERCreW8_4zXItuTl_KiXZNU5lvMQjWbIw2eTx1lpsflo0rYU',
            'dq'  => 'iEgcO-QfpepdH8FWd7mUFyrXdnOkXJBCogChY6YKuIHGc_p8Le9MbpFKESzEaLlN1Ehf3B6oGBl5Iz_ayUlZj2IoQZ82znoUrpa9fVYNot87ACfzIG7q9Mv7RiPAderZi03tkVXAdaBau_9vs5rS-7HMtxkVrxSUvJY14TkXlHE',
            'qi'  => 'kC-lzZOqoFaZCr5l0tOVtREKoVqaAYhQiqIRGL-MzS4sCmRkxm5vZlXYx6RtE1n_AagjqajlkjieGlxTTThHD8Iga6foGBMaAr5uR1hGQpSc7Gl7CF1DZkBJMTQN6EshYzZfxW08mIO8M6Rzuh0beL6fG9mkDcIyPrBXx2bQ_mM',
        ]);

        $recipient_2_private_key = JWK::create([
            'kty' => 'EC',
            'kid' => 'peregrin.took@tuckborough.example',
            'use' => 'enc',
            'crv' => 'P-384',
            'x'   => 'YU4rRUzdmVqmRtWOs2OpDE_T5fsNIodcG8G5FWPrTPMyxpzsSOGaQLpe2FpxBmu2',
            'y'   => 'A8-yxCHxkfBz3hKZfI1jUYMjUhsEveZ9THuwFjH2sCNdtksRJU7D5-SkgaFL1ETP',
            'd'   => 'iTx2pk7wW-GqJkHcEkFQb2EFyYcO7RugmaW3mRrQVAOUiPommT0IdnYK2xDlZh-j',
        ]);

        $recipient_3_private_key = JWK::create([
            'kty' => 'oct',
            'kid' => '18ec08e1-bfa9-4d95-b205-2b4dd1d4321d',
            'use' => 'enc',
            'alg' => 'A256GCMKW',
            'k'   => 'qC57l_uxcm7Nm3K-ct4GFjx8tM1U8CZ0NLBvdQstiS8',
        ]);

        $protectedHeader = [
            'enc' => 'A128CBC-HS256',
        ];

        $header = [
            'cty' => 'text/plain',
        ];

        $recipient_1Header = [
            'alg' => 'RSA1_5',
            'kid' => 'frodo.baggins@hobbiton.example',
        ];

        $recipient_2Header = [
            'alg' => 'ECDH-ES+A256KW',
            'kid' => 'peregrin.took@tuckborough.example',
            'epk' => [
                'kty' => 'EC',
                'crv' => 'P-384',
                'x'   => 'Uzdvk3pi5wKCRc1izp5_r0OjeqT-I68i8g2b8mva8diRhsE2xAn2DtMRb25Ma2CX',
                'y'   => 'VDrRyFJh-Kwd1EjAgmj5Eo-CTHAZ53MC7PjjpLioy3ylEjI1pOMbw91fzZ84pbfm',
        ], ];

        $recipient_3Header = [
            'alg' => 'A256GCMKW',
            'kid' => '18ec08e1-bfa9-4d95-b205-2b4dd1d4321d',
            'tag' => '59Nqh1LlYtVIhfD3pgRGvw',
            'iv'  => 'AvpeoPZ9Ncn9mkBn',
        ];

        $expected_json = '{"recipients":[{"encrypted_key":"dYOD28kab0Vvf4ODgxVAJXgHcSZICSOp8M51zjwj4w6Y5G4XJQsNNIBiqyvUUAOcpL7S7-cFe7Pio7gV_Q06WmCSa-vhW6me4bWrBf7cHwEQJdXihidAYWVajJIaKMXMvFRMV6iDlRr076DFthg2_AV0_tSiV6xSEIFqt1xnYPpmP91tc5WJDOGb-wqjw0-b-S1laS11QVbuP78dQ7Fa0zAVzzjHX-xvyM2wxj_otxr9clN1LnZMbeYSrRicJK5xodvWgkpIdkMHo4LvdhRRvzoKzlic89jFWPlnBq_V4n5trGuExtp_-dbHcGlihqc_wGgho9fLMK8JOArYLcMDNQ","header":{"alg":"RSA1_5","kid":"frodo.baggins@hobbiton.example"}},{"encrypted_key":"ExInT0io9BqBMYF6-maw5tZlgoZXThD1zWKsHixJuw_elY4gSSId_w","header":{"alg":"ECDH-ES+A256KW","kid":"peregrin.took@tuckborough.example","epk":{"kty":"EC","crv":"P-384","x":"Uzdvk3pi5wKCRc1izp5_r0OjeqT-I68i8g2b8mva8diRhsE2xAn2DtMRb25Ma2CX","y":"VDrRyFJh-Kwd1EjAgmj5Eo-CTHAZ53MC7PjjpLioy3ylEjI1pOMbw91fzZ84pbfm"}}},{"encrypted_key":"a7CclAejo_7JSuPB8zeagxXRam8dwCfmkt9-WyTpS1E","header":{"alg":"A256GCMKW","kid":"18ec08e1-bfa9-4d95-b205-2b4dd1d4321d","tag":"59Nqh1LlYtVIhfD3pgRGvw","iv":"AvpeoPZ9Ncn9mkBn"}}],"unprotected":{"cty":"text/plain"},"protected":"eyJlbmMiOiJBMTI4Q0JDLUhTMjU2In0","iv":"VgEIHY20EnzUtZFl2RpB1g","ciphertext":"ajm2Q-OpPXCr7-MHXicknb1lsxLdXxK_yLds0KuhJzfWK04SjdxQeSw2L9mu3a_k1C55kCQ_3xlkcVKC5yr__Is48VOoK0k63_QRM9tBURMFqLByJ8vOYQX0oJW4VUHJLmGhF-tVQWB7Kz8mr8zeE7txF0MSaP6ga7-siYxStR7_G07Thd1jh-zGT0wxM5g-VRORtq0K6AXpLlwEqRp7pkt2zRM0ZAXqSpe1O6FJ7FHLDyEFnD-zDIZukLpCbzhzMDLLw2-8I14FQrgi-iEuzHgIJFIJn2wh9Tj0cg_kOZy9BqMRZbmYXMY9YQjorZ_P_JYG3ARAIF3OjDNqpdYe-K_5Q5crGJSDNyij_ygEiItR5jssQVH2ofDQdLChtazE","tag":"BESYyFN7T09KY7i8zKs5_g"}';
        $expected_iv = 'VgEIHY20EnzUtZFl2RpB1g';
        $expected_recipient_1_encrypted_key = 'dYOD28kab0Vvf4ODgxVAJXgHcSZICSOp8M51zjwj4w6Y5G4XJQsNNIBiqyvUUAOcpL7S7-cFe7Pio7gV_Q06WmCSa-vhW6me4bWrBf7cHwEQJdXihidAYWVajJIaKMXMvFRMV6iDlRr076DFthg2_AV0_tSiV6xSEIFqt1xnYPpmP91tc5WJDOGb-wqjw0-b-S1laS11QVbuP78dQ7Fa0zAVzzjHX-xvyM2wxj_otxr9clN1LnZMbeYSrRicJK5xodvWgkpIdkMHo4LvdhRRvzoKzlic89jFWPlnBq_V4n5trGuExtp_-dbHcGlihqc_wGgho9fLMK8JOArYLcMDNQ';
        $expected_recipient_2_encrypted_key = 'ExInT0io9BqBMYF6-maw5tZlgoZXThD1zWKsHixJuw_elY4gSSId_w';
        $expected_recipient_3_encrypted_key = 'a7CclAejo_7JSuPB8zeagxXRam8dwCfmkt9-WyTpS1E';
        $expected_ciphertext = 'ajm2Q-OpPXCr7-MHXicknb1lsxLdXxK_yLds0KuhJzfWK04SjdxQeSw2L9mu3a_k1C55kCQ_3xlkcVKC5yr__Is48VOoK0k63_QRM9tBURMFqLByJ8vOYQX0oJW4VUHJLmGhF-tVQWB7Kz8mr8zeE7txF0MSaP6ga7-siYxStR7_G07Thd1jh-zGT0wxM5g-VRORtq0K6AXpLlwEqRp7pkt2zRM0ZAXqSpe1O6FJ7FHLDyEFnD-zDIZukLpCbzhzMDLLw2-8I14FQrgi-iEuzHgIJFIJn2wh9Tj0cg_kOZy9BqMRZbmYXMY9YQjorZ_P_JYG3ARAIF3OjDNqpdYe-K_5Q5crGJSDNyij_ygEiItR5jssQVH2ofDQdLChtazE';
        $expected_tag = 'BESYyFN7T09KY7i8zKs5_g';

        $jweDecrypter = $this->getJWEDecrypterFactory()->create(['RSA1_5', 'ECDH-ES+A256KW', 'A256GCMKW'], ['A128CBC-HS256'], ['DEF']);

        $loaded_json = $this->getJWESerializerManager()->unserialize($expected_json);
        self::assertTrue($jweDecrypter->decryptUsingKey($loaded_json, $recipient_1_private_key, 0));

        $loaded_json = $this->getJWESerializerManager()->unserialize($expected_json);
        self::assertTrue($jweDecrypter->decryptUsingKey($loaded_json, $recipient_2_private_key, 1));

        $loaded_json = $this->getJWESerializerManager()->unserialize($expected_json);
        self::assertTrue($jweDecrypter->decryptUsingKey($loaded_json, $recipient_3_private_key, 2));

        self::assertEquals($expected_ciphertext, Base64Url::encode($loaded_json->getCiphertext()));
        self::assertEquals($protectedHeader, $loaded_json->getSharedProtectedHeader());
        self::assertEquals($expected_iv, Base64Url::encode($loaded_json->getIV()));
        self::assertEquals($expected_recipient_1_encrypted_key, Base64Url::encode($loaded_json->getRecipient(0)->getEncryptedKey()));
        self::assertEquals($expected_recipient_2_encrypted_key, Base64Url::encode($loaded_json->getRecipient(1)->getEncryptedKey()));
        self::assertEquals($expected_recipient_3_encrypted_key, Base64Url::encode($loaded_json->getRecipient(2)->getEncryptedKey()));
        self::assertEquals($recipient_1Header, $loaded_json->getRecipient(0)->getHeader());
        self::assertEquals($recipient_2Header, $loaded_json->getRecipient(1)->getHeader());
        self::assertEquals($recipient_3Header, $loaded_json->getRecipient(2)->getHeader());
        self::assertEquals($header, $loaded_json->getSharedHeader());
        self::assertEquals($expected_tag, Base64Url::encode($loaded_json->getTag()));

        self::assertEquals($expected_payload, $loaded_json->getPayload());
    }

    /**
     * Same input as before, but we perform the encryption first.
     */
    public function testMultipleRecipientEncryptionBis()
    {
        $expected_payload = "You can trust us to stick with you through thick and thin\xe2\x80\x93to the bitter end. And you can trust us to keep any secret of yours\xe2\x80\x93closer than you keep it yourself. But you cannot trust us to let you face trouble alone, and go off without a word. We are your friends, Frodo.";

        $recipient_1_private_key = JWK::create([
            'kty' => 'RSA',
            'kid' => 'frodo.baggins@hobbiton.example',
            'use' => 'enc',
            'n'   => 'maxhbsmBtdQ3CNrKvprUE6n9lYcregDMLYNeTAWcLj8NnPU9XIYegTHVHQjxKDSHP2l-F5jS7sppG1wgdAqZyhnWvXhYNvcM7RfgKxqNx_xAHx6f3yy7s-M9PSNCwPC2lh6UAkR4I00EhV9lrypM9Pi4lBUop9t5fS9W5UNwaAllhrd-osQGPjIeI1deHTwx-ZTHu3C60Pu_LJIl6hKn9wbwaUmA4cR5Bd2pgbaY7ASgsjCUbtYJaNIHSoHXprUdJZKUMAzV0WOKPfA6OPI4oypBadjvMZ4ZAj3BnXaSYsEZhaueTXvZB4eZOAjIyh2e_VOIKVMsnDrJYAVotGlvMQ',
            'e'   => 'AQAB',
            'd'   => 'Kn9tgoHfiTVi8uPu5b9TnwyHwG5dK6RE0uFdlpCGnJN7ZEi963R7wybQ1PLAHmpIbNTztfrheoAniRV1NCIqXaW_qS461xiDTp4ntEPnqcKsyO5jMAji7-CL8vhpYYowNFvIesgMoVaPRYMYT9TW63hNM0aWs7USZ_hLg6Oe1mY0vHTI3FucjSM86Nff4oIENt43r2fspgEPGRrdE6fpLc9Oaq-qeP1GFULimrRdndm-P8q8kvN3KHlNAtEgrQAgTTgz80S-3VD0FgWfgnb1PNmiuPUxO8OpI9KDIfu_acc6fg14nsNaJqXe6RESvhGPH2afjHqSy_Fd2vpzj85bQQ',
            'p'   => '2DwQmZ43FoTnQ8IkUj3BmKRf5Eh2mizZA5xEJ2MinUE3sdTYKSLtaEoekX9vbBZuWxHdVhM6UnKCJ_2iNk8Z0ayLYHL0_G21aXf9-unynEpUsH7HHTklLpYAzOOx1ZgVljoxAdWNn3hiEFrjZLZGS7lOH-a3QQlDDQoJOJ2VFmU',
            'q'   => 'te8LY4-W7IyaqH1ExujjMqkTAlTeRbv0VLQnfLY2xINnrWdwiQ93_VF099aP1ESeLja2nw-6iKIe-qT7mtCPozKfVtUYfz5HrJ_XY2kfexJINb9lhZHMv5p1skZpeIS-GPHCC6gRlKo1q-idn_qxyusfWv7WAxlSVfQfk8d6Et0',
            'dp'  => 'UfYKcL_or492vVc0PzwLSplbg4L3-Z5wL48mwiswbpzOyIgd2xHTHQmjJpFAIZ8q-zf9RmgJXkDrFs9rkdxPtAsL1WYdeCT5c125Fkdg317JVRDo1inX7x2Kdh8ERCreW8_4zXItuTl_KiXZNU5lvMQjWbIw2eTx1lpsflo0rYU',
            'dq'  => 'iEgcO-QfpepdH8FWd7mUFyrXdnOkXJBCogChY6YKuIHGc_p8Le9MbpFKESzEaLlN1Ehf3B6oGBl5Iz_ayUlZj2IoQZ82znoUrpa9fVYNot87ACfzIG7q9Mv7RiPAderZi03tkVXAdaBau_9vs5rS-7HMtxkVrxSUvJY14TkXlHE',
            'qi'  => 'kC-lzZOqoFaZCr5l0tOVtREKoVqaAYhQiqIRGL-MzS4sCmRkxm5vZlXYx6RtE1n_AagjqajlkjieGlxTTThHD8Iga6foGBMaAr5uR1hGQpSc7Gl7CF1DZkBJMTQN6EshYzZfxW08mIO8M6Rzuh0beL6fG9mkDcIyPrBXx2bQ_mM',
        ]);

        $recipient_2_public_key = JWK::create([
            'kty' => 'EC',
            'kid' => 'peregrin.took@tuckborough.example',
            'use' => 'enc',
            'crv' => 'P-384',
            'x'   => 'YU4rRUzdmVqmRtWOs2OpDE_T5fsNIodcG8G5FWPrTPMyxpzsSOGaQLpe2FpxBmu2',
            'y'   => 'A8-yxCHxkfBz3hKZfI1jUYMjUhsEveZ9THuwFjH2sCNdtksRJU7D5-SkgaFL1ETP',
        ]);

        $recipient_2_private_key = JWK::create([
            'kty' => 'EC',
            'kid' => 'peregrin.took@tuckborough.example',
            'use' => 'enc',
            'crv' => 'P-384',
            'x'   => 'YU4rRUzdmVqmRtWOs2OpDE_T5fsNIodcG8G5FWPrTPMyxpzsSOGaQLpe2FpxBmu2',
            'y'   => 'A8-yxCHxkfBz3hKZfI1jUYMjUhsEveZ9THuwFjH2sCNdtksRJU7D5-SkgaFL1ETP',
            'd'   => 'iTx2pk7wW-GqJkHcEkFQb2EFyYcO7RugmaW3mRrQVAOUiPommT0IdnYK2xDlZh-j',
        ]);

        $recipient_3_private_key = JWK::create([
            'kty' => 'oct',
            'kid' => '18ec08e1-bfa9-4d95-b205-2b4dd1d4321d',
            'use' => 'enc',
            'alg' => 'A256GCMKW',
            'k'   => 'qC57l_uxcm7Nm3K-ct4GFjx8tM1U8CZ0NLBvdQstiS8',
        ]);

        $protectedHeader = [
            'enc' => 'A128CBC-HS256',
        ];

        $header = [
            'cty' => 'text/plain',
        ];

        $recipient_1Header = [
            'alg' => 'RSA1_5',
            'kid' => 'frodo.baggins@hobbiton.example',
        ];

        $recipient_2Header = [
            'alg' => 'ECDH-ES+A256KW',
            'kid' => 'peregrin.took@tuckborough.example',
        ];

        $recipient_3Header = [
            'alg' => 'A256GCMKW',
            'kid' => '18ec08e1-bfa9-4d95-b205-2b4dd1d4321d',
        ];

        $jweBuilder = $this->getJWEBuilderFactory()->create(['RSA1_5', 'ECDH-ES+A256KW', 'A256GCMKW'], ['A128CBC-HS256'], ['DEF']);
        $jweDecrypter = $this->getJWEDecrypterFactory()->create(['RSA1_5', 'ECDH-ES+A256KW', 'A256GCMKW'], ['A128CBC-HS256'], ['DEF']);

        $jwe = $jweBuilder
            ->create()->withPayload($expected_payload)
            ->withSharedProtectedHeader($protectedHeader)
            ->withSharedHeader($header)
            ->addRecipient($recipient_1_private_key, $recipient_1Header)
            ->addRecipient($recipient_2_public_key, $recipient_2Header)
            ->addRecipient($recipient_3_private_key, $recipient_3Header)
            ->build();

        $loaded_json = $this->getJWESerializerManager()->unserialize($this->getJWESerializerManager()->serialize('jwe_json_general', $jwe));
        self::assertTrue($jweDecrypter->decryptUsingKey($loaded_json, $recipient_1_private_key, 0));

        $loaded_json = $this->getJWESerializerManager()->unserialize($this->getJWESerializerManager()->serialize('jwe_json_general', $jwe));
        self::assertTrue($jweDecrypter->decryptUsingKey($loaded_json, $recipient_2_private_key, 1));

        $loaded_json = $this->getJWESerializerManager()->unserialize($this->getJWESerializerManager()->serialize('jwe_json_general', $jwe));
        self::assertTrue($jweDecrypter->decryptUsingKey($loaded_json, $recipient_3_private_key, 2));

        self::assertEquals($protectedHeader, $loaded_json->getSharedProtectedHeader());
        self::assertEquals($recipient_1Header, $loaded_json->getRecipient(0)->getHeader());
        self::assertTrue(array_key_exists('epk', $loaded_json->getRecipient(1)->getHeader()));
        self::assertTrue(array_key_exists('iv', $loaded_json->getRecipient(2)->getHeader()));
        self::assertTrue(array_key_exists('tag', $loaded_json->getRecipient(2)->getHeader()));
        self::assertEquals($header, $loaded_json->getSharedHeader());

        self::assertEquals($expected_payload, $loaded_json->getPayload());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Inconsistent content encryption algorithm
     */
    public function testMultipleRecipientEncryptionWithDifferentContentEncryptionAlgorithm()
    {
        $expected_payload = "You can trust us to stick with you through thick and thin\xe2\x80\x93to the bitter end. And you can trust us to keep any secret of yours\xe2\x80\x93closer than you keep it yourself. But you cannot trust us to let you face trouble alone, and go off without a word. We are your friends, Frodo.";

        $recipient_1_private_key = JWK::create([
            'kty' => 'RSA',
            'kid' => 'frodo.baggins@hobbiton.example',
            'use' => 'enc',
            'n'   => 'maxhbsmBtdQ3CNrKvprUE6n9lYcregDMLYNeTAWcLj8NnPU9XIYegTHVHQjxKDSHP2l-F5jS7sppG1wgdAqZyhnWvXhYNvcM7RfgKxqNx_xAHx6f3yy7s-M9PSNCwPC2lh6UAkR4I00EhV9lrypM9Pi4lBUop9t5fS9W5UNwaAllhrd-osQGPjIeI1deHTwx-ZTHu3C60Pu_LJIl6hKn9wbwaUmA4cR5Bd2pgbaY7ASgsjCUbtYJaNIHSoHXprUdJZKUMAzV0WOKPfA6OPI4oypBadjvMZ4ZAj3BnXaSYsEZhaueTXvZB4eZOAjIyh2e_VOIKVMsnDrJYAVotGlvMQ',
            'e'   => 'AQAB',
            'd'   => 'Kn9tgoHfiTVi8uPu5b9TnwyHwG5dK6RE0uFdlpCGnJN7ZEi963R7wybQ1PLAHmpIbNTztfrheoAniRV1NCIqXaW_qS461xiDTp4ntEPnqcKsyO5jMAji7-CL8vhpYYowNFvIesgMoVaPRYMYT9TW63hNM0aWs7USZ_hLg6Oe1mY0vHTI3FucjSM86Nff4oIENt43r2fspgEPGRrdE6fpLc9Oaq-qeP1GFULimrRdndm-P8q8kvN3KHlNAtEgrQAgTTgz80S-3VD0FgWfgnb1PNmiuPUxO8OpI9KDIfu_acc6fg14nsNaJqXe6RESvhGPH2afjHqSy_Fd2vpzj85bQQ',
            'p'   => '2DwQmZ43FoTnQ8IkUj3BmKRf5Eh2mizZA5xEJ2MinUE3sdTYKSLtaEoekX9vbBZuWxHdVhM6UnKCJ_2iNk8Z0ayLYHL0_G21aXf9-unynEpUsH7HHTklLpYAzOOx1ZgVljoxAdWNn3hiEFrjZLZGS7lOH-a3QQlDDQoJOJ2VFmU',
            'q'   => 'te8LY4-W7IyaqH1ExujjMqkTAlTeRbv0VLQnfLY2xINnrWdwiQ93_VF099aP1ESeLja2nw-6iKIe-qT7mtCPozKfVtUYfz5HrJ_XY2kfexJINb9lhZHMv5p1skZpeIS-GPHCC6gRlKo1q-idn_qxyusfWv7WAxlSVfQfk8d6Et0',
            'dp'  => 'UfYKcL_or492vVc0PzwLSplbg4L3-Z5wL48mwiswbpzOyIgd2xHTHQmjJpFAIZ8q-zf9RmgJXkDrFs9rkdxPtAsL1WYdeCT5c125Fkdg317JVRDo1inX7x2Kdh8ERCreW8_4zXItuTl_KiXZNU5lvMQjWbIw2eTx1lpsflo0rYU',
            'dq'  => 'iEgcO-QfpepdH8FWd7mUFyrXdnOkXJBCogChY6YKuIHGc_p8Le9MbpFKESzEaLlN1Ehf3B6oGBl5Iz_ayUlZj2IoQZ82znoUrpa9fVYNot87ACfzIG7q9Mv7RiPAderZi03tkVXAdaBau_9vs5rS-7HMtxkVrxSUvJY14TkXlHE',
            'qi'  => 'kC-lzZOqoFaZCr5l0tOVtREKoVqaAYhQiqIRGL-MzS4sCmRkxm5vZlXYx6RtE1n_AagjqajlkjieGlxTTThHD8Iga6foGBMaAr5uR1hGQpSc7Gl7CF1DZkBJMTQN6EshYzZfxW08mIO8M6Rzuh0beL6fG9mkDcIyPrBXx2bQ_mM',
        ]);

        $recipient_2_public_key = JWK::create([
            'kty' => 'EC',
            'kid' => 'peregrin.took@tuckborough.example',
            'use' => 'enc',
            'crv' => 'P-384',
            'x'   => 'YU4rRUzdmVqmRtWOs2OpDE_T5fsNIodcG8G5FWPrTPMyxpzsSOGaQLpe2FpxBmu2',
            'y'   => 'A8-yxCHxkfBz3hKZfI1jUYMjUhsEveZ9THuwFjH2sCNdtksRJU7D5-SkgaFL1ETP',
        ]);

        $protectedHeader = [];

        $header = [
            'cty' => 'text/plain',
        ];

        $recipient_1Header = [
            'alg' => 'RSA1_5',
            'enc' => 'A128GCM',
            'kid' => 'frodo.baggins@hobbiton.example',
        ];

        $recipient_2Header = [
            'alg' => 'ECDH-ES+A256KW',
            'enc' => 'A128CBC-HS256',
            'kid' => 'peregrin.took@tuckborough.example',
        ];

        $jweBuilder = $this->getJWEBuilderFactory()->create(['RSA1_5', 'A256GCMKW'], ['A128CBC-HS256', 'A128GCM'], ['DEF']);
        $jweBuilder
            ->create()
            ->withPayload($expected_payload)
            ->withSharedProtectedHeader($protectedHeader)
            ->withSharedHeader($header)
            ->addRecipient($recipient_1_private_key, $recipient_1Header)
            ->addRecipient($recipient_2_public_key, $recipient_2Header)
            ->build();
    }
}
