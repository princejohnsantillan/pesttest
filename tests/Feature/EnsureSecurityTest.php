<?php

use Database\Factories\UserFactory;
use Illuminate\Support\Facades\Hash;

test('user password is hashed', function (): void {
    $user = UserFactory::new()->create([
        'password' => 'password',
    ]);

    expect(Hash::check('password', $user->password))->toBeTrue();
});
