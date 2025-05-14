<?php

include_once __DIR__ . "/../config.php";

class JWT {
	public static function encode( array $payload ): string {
		$header = [
			'alg' => 'HS512',
			'typ' => 'JWT'
		];

		$encodedHeader = rtrim( strtr( base64_encode( json_encode( $header ) ), '+/', '-_' ), '=' );
		$encodedPayload = rtrim( strtr( base64_encode( json_encode( $payload ) ), '+/', '-_' ), '=' );

		$signature = hash_hmac( 'sha512', "$encodedHeader.$encodedPayload", JWT_SIGN, true );
		$encodedSignature = rtrim( strtr( base64_encode( $signature ), '+/', '-_'), '=' );

		return "{$encodedHeader}.{$encodedPayload}.{$encodedSignature}";
	}

	public static function decode( string $token ):? array {
		$tokenParts = explode( '.', $token );

		if ( count( $tokenParts ) !== 3 ) {
			// Invalid JWT format
			return null;
		}

		list( $encodedHeader, $encodedPayload, $providedSignature ) = $tokenParts;

		$header = json_decode( base64_decode( strtr( $encodedHeader, '-_', '+/' ) ), true );
		$payload = json_decode( base64_decode( strtr( $encodedPayload, '-_', '+/' ) ), true );
		$signature = base64_decode( strtr( $providedSignature, '-_', '+/' ) );

		if ( $header === null || $payload === null ) {
			// Validate JSON decoding
			return null;
		}

		// Re-create signature
		$validSignature = hash_hmac( 'sha512', "$encodedHeader.$encodedPayload", JWT_SIGN, true );

		if ( !hash_equals( $signature, $validSignature ) ) {
			// Invalid signature
			return null;
		}

		return [
			'header' => $header,
			'body' => $payload
		];
	}
}

?>
