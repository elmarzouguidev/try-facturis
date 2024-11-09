<?php

it('has form page', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
