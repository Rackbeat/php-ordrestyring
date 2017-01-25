<?php namespace LasseRafn\Ordrestyring\Utils\ModelTraits;

trait SetsAttributes
{
	protected $casts = [];

	private function setAttribute( $key, $value )
	{
		$key = trim($key);

		$this->{$key} = $this->cast( $key, $value );
	}

	private function cast( $key, $value )
	{
		$formattedKey = ucfirst( camel_case( $key ) );

		if ( method_exists($this, "set{$formattedKey}Attribute" ) )
		{
			return $this->{"set{$formattedKey}Attribute"}($value);
		}

		if ( $value === null || ! isset( $this->casts[ $key ] ) )
		{
			return $value;
		}

		switch ( $this->casts[ $key ] )
		{
			case 'int':
			case 'integer':
				return (int) $value;

			case 'float':
				return (float) $value;

			case 'date':
				return date( 'Y-m-d', strtotime( $value ) );

			case 'datetime':
				return new \DateTime( strtotime( $value ) );

			case 'double':
			case 'decimal':
				return (double) $value;

			case 'bool':
			case 'boolean':
				return (bool) $value;

			default:
			case 'string':
				return (string) $value;
		}
	}
}