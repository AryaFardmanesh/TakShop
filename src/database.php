<?php

include_once "./config.php";

class Database {
	public ?string $error_message = null;

	public ?mysqli $connection = null;

	public function connect(): bool {
		$this->connection = mysqli_connect(
			DB_HOSTNAME,
			DB_USERNAME,
			DB_PASSWORD,
			DB_NAME,
		);

		if ( $this->connection == null )
			return false;
		return true;
	}

	public function disconnect(): void {
		mysqli_close( $this->connection );
		$this->connection = null;
	}

	public function isConnect(): bool {
		return $this->connection != null;
	}

	public function execute( string $query ): mysqli_result | bool {
		if ( !$this->isConnect() ) {
			$this->error_message = "Database is not connected for execute the query.";
			return false;
		}

		return mysqli_query( $this->connection, $query );
	}

	public function init(): bool {
		$initDatabaseFile = fopen( DATABASE_INIT_FILE_ADDRESS, 'r' );

		if ( !$initDatabaseFile ) {
			$this->error_message = "Cannot read init database file.";
			return false;
		}

		$initQuery = fread( $initDatabaseFile, filesize( DATABASE_INIT_FILE_ADDRESS ) );
		$result = $this->execute( $initQuery );

		fclose( $initDatabaseFile );

		return $result || false;
	}
}

?>
