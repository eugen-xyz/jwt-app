<?php

namespace App\ValueObjects;

/**
 * Class Percentage
 * @package App\ValueObjects
 */
class Percentage {

	/** $percent
	 *
	 *  Percentage value.
	 *
	 * @var float
	 */
	protected $percent = 0.0;

	/** create
	 *
	 *  Constructor.
	 *
	 * @param $percent
	 */
	public function __construct($percent) {
		$this->percent = $percent;
	}

	/**
	 * @return bool
	 */
	public function isZero() {
		return empty($this->percent);
	}

	/** create
	 *
	 *  Factory constructor.
	 *
	 * @param $percent
	 * @return Percentage
	 */
	public static function create($percent) {
		return new self($percent);
	}

	/** createFromNormalizedFloat
	 *
	 *  Create from a value between 0 and 1.
	 *
	 * @param $percent
	 * @return Percentage
	 */
	public static function createFromNormalizedFloat($percent) {
		return new self($percent * 100);
	}

	/** toNativeType
	 *
	 *  Returns value as native PHP type.
	 *
	 * @return float
	 */
	public function toNativeType() {
		return $this->percent;
	}

	/** asNormalizedFloat
	 *
	 *  Returns the percentage as a float between 0 and 1.
	 *
	 * @return float
	 */
	public function asNormalizedFloat() {
		return $this->percent / 100;
	}

} 