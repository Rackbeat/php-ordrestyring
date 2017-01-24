<?php namespace LasseRafn\Ordrestyring\Utils;

use Illuminate\Support\Collection;

class RequestBuilder
{
	const SORTORDER_ASC  = '+';
	const SORTORDER_DESC = '-';

	const FILTER_LT  = '-st';
	const FILTER_GT  = '-gt';
	const FILTER_EQ  = '';
	const FILTER_NOT = '-not';
	const FILTER_GTE = '-min';
	const FILTER_LTE = '-max';

	private $sortBy    = '';
	private $filters   = [];
	private $includes  = [];
	private $pageSize  = 50;
	private $sortOrder = self::SORTORDER_ASC;
	private $pageNumber;

	protected $urlParameters = '';

	/**
	 * Set page number (min: 1)
	 *
	 * @param int $page
	 *
	 * @return RequestBuilder
	 */
	public function page( int $page = 1 ): self
	{
		$this->pageNumber = $page;

		return $this;
	}

	/**
	 * Set amount of results per page
	 * Their API documentation mentions nothing of a max.
	 *
	 * @param int $perPage
	 *
	 * @return RequestBuilder
	 */
	public function perPage( int $perPage = 1 ): self
	{
		$this->pageSize = $perPage;

		return $this;
	}

	/**
	 * Add includes / relationships
	 * You can pass in strings, arrays or Illuminate Collections.
	 *
	 * @param string|array|Collection $relatedModel
	 *
	 * @return RequestBuilder
	 */
	public function with( $relatedModel ): self
	{
		if ( is_array( $relatedModel ) )
		{
			$relatedModel = collect( $relatedModel );
		}

		if ( $relatedModel instanceof Collection )
		{
			$relatedModel->each( function ( $item )
			{
				$this->includes[] = $item;
			} );
		}

		if ( is_string( $relatedModel ) )
		{
			$this->includes[] = $relatedModel;
		}

		return $this;
	}

	/**
	 * Add filters to the query
	 * You can specify a filter with only two arguments (leaving out value)
	 * and it will default to compare the $column and $comparison as an
	 * "equals to" statement.
	 *
	 * Passing in an array or Illuminate Collection as the value, will split it
	 * up divided by a pipe, hence turning into an OR comparison.
	 *
	 * Adding a filter to an already filtered column, will add it as an OR comparison.
	 *
	 * @param string                       $column
	 * @param string|array|Collection      $comparison
	 * @param null|string|array|Collection $value
	 *
	 * @return RequestBuilder
	 */
	public function where( $column, $comparison, $value = null ): self
	{
		if ( func_num_args() === 2 )
		{
			$value      = $comparison;
			$comparison = self::FILTER_EQ;
		}

		if ( $value instanceof Collection )
		{
			$value = $value->toArray();
		}

		if ( is_array( $value ) )
		{
			$value = implode( '|', $value );
		}

		$comparison = $this->createFilterComparison( $comparison );

		$column = "{$column}{$comparison}";

		if ( isset( $this->filters[ $column ] ) )
		{
			$this->filters[ $column ] .= '|' . $value;
		}
		else
		{
			$this->filters[ $column ] = $value;
		}

		return $this;
	}

	/**
	 * Set the sort order to be ascending
	 *
	 * @return RequestBuilder
	 */
	public function sortAscending(): self
	{
		$this->sortOrder = self::SORTORDER_ASC;

		return $this;
	}

	/**
	 * Set the sort order to be descending
	 *
	 * @return RequestBuilder
	 */
	public function sortDescending(): self
	{
		$this->sortOrder = self::SORTORDER_DESC;

		return $this;
	}

	/**
	 * Set the column to sort by
	 *
	 * @param string $column
	 *
	 * @return RequestBuilder
	 */
	public function sortBy( string $column ): self
	{
		$this->sortBy = $column;

		return $this;
	}

	/**
	 * Build the HTTP query for the actual request
	 *
	 * @return RequestBuilder
	 */
	public function buildRequest(): self
	{
		$this->initUrlParameter()
		     ->buildFilters()
		     ->buildIncludes()
		     ->buildPagination();

		return $this;
	}

	/**
	 * Build the HTTP query for filters
	 *
	 * @return RequestBuilder
	 */
	private function buildFilters(): self
	{
		if ( count( $this->filters ) === 0 )
		{
			return $this;
		}

		$this->urlParameters .= http_build_query( $this->filters );

		return $this;
	}

	/**
	 * Build the HTTP query for includes
	 *
	 * @return RequestBuilder
	 */
	private function buildIncludes(): self
	{
		if ( count( $this->includes ) === 0 )
		{
			return $this;
		}

		if ( $this->urlParameters !== '?' )
		{
			$this->urlParameters .= '&';
		}

		$this->urlParameters .= 'include=' . implode( ',', $this->includes );

		return $this;
	}

	/**
	 * Build the HTTP query for pagination
	 *
	 * @return RequestBuilder
	 */
	private function buildPagination(): self
	{
		if ( $this->pageNumber === null )
		{
			return $this;
		}

		if ( $this->urlParameters !== '?' )
		{
			$this->urlParameters .= '&';
		}

		$this->urlParameters .= http_build_query( [ 'page' => $this->pageNumber, 'pagesize' => $this->pageSize ] );

		return $this;
	}

	/**
	 * Generates a comparison-string according to Ordrestyring specs.
	 *
	 * @param string $comparison
	 *
	 * @return string
	 */
	private function createFilterComparison( string $comparison = '=' )
	{
		switch ( (string) strtolower( $comparison ) )
		{
			case '<':
				return self::FILTER_LT;

			case '<=':
				return self::FILTER_LTE;

			case '>':
				return self::FILTER_GT;

			case '>=':
				return self::FILTER_GTE;

			case '!=':
			case '!==':
			case 'not':
				return self::FILTER_NOT;

			default:
			case '=':
			case '==':
				return self::FILTER_EQ;
		}
	}

	/**
	 * Initialize a urlParameter
	 *
	 * @return RequestBuilder
	 */
	private function initUrlParameter(): self
	{
		if ( $this->urlParameters === '' )
		{
			$this->urlParameters = '?';
		}

		return $this;
	}
}