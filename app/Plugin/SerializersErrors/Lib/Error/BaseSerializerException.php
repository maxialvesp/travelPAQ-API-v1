<?php
/**
 * Custom Exceptions for Serializable style interface
 *
 * @package JsonApiExceptions.Lib.Error
 */

/**
 * BaseSerializerException
 *
 * Generic base exception for other plugins and userland code to extend from
 */
class BaseSerializerException extends CakeException {

	/**
	 * A short, human-readable summary of the problem. It SHOULD NOT change from
	 * occurrence to occurrence of the problem, except for purposes of
	 * localization.
	 *
	 * @var string
	 */
	public $title = "Base Serializer Exception";

	/**
	 * A human-readable explanation specific to this occurrence of the problem.
	 *
	 * @var string
	 */
	public $detail = "Base Serializer Exception";

	/**
	 * An application-specific error code, expressed as a string value.
	 *
	 * @var string
	 */
	public $code = "400";

	/**
	 * A URI that MAY yield further details about this particular occurrence
	 * of the problem.
	 *
	 * @var string
	 */
	public $href = null;

	/**
	 * A unique identifier for this particular occurrence of the problem.
	 *
	 * @var string
	 */
	public $id = null;

	/**
	 * The HTTP status code applicable to this problem, expressed as a string
	 * value.
	 *
	 * @var int
	 */
	public $status = 400;

	/**
	 * Associated resources which can be dereferenced from the request document.
	 *
	 * @var array
	 */
	public $links = array();

	/**
	 * The relative path to the relevant attribute within the associated
	 * resource(s). Only appropriate for problems that apply to a single
	 * resource or type of resource.
	 *
	 * @var array
	 */
	public $path = array();

	/**
	 * Constructs a new instance of the base BaseJsonApiException
	 *
	 * @param string $title The title of the exception, passed to parent CakeException::__construct
	 * @param string $detail A human-readable explanation specific to this occurrence of the problem.
	 * @param int $status The http status code of the error, passed to parent CakeException::__construct
	 * @param string $id A unique identifier for this particular occurrence of the problem.
	 * @param string $href A URI that MAY yield further details about this particular occurrence of the problem.
	 * @param array $links An array of JSON Pointers [RFC6901] to the associated resource(s) within the request document [e.g. ["/data"] for a primary data object].
	 * @param array $paths An array of JSON Pointers to the relevant attribute(s) within the associated resource(s) in the request document. Each path MUST be relative to the resource path(s) expressed in the error object's "links" member [e.g. ["/first-name", "/last-name"] to reference a couple attributes].
	 */
	public function __construct(
		$title = 'Base Serializer Exception',
		$detail = 'Base Serializer Exception',
		$status = 400,
		$id = null,
		$href = null,
		$links = array(),
		$paths = array()
	) {
		// Set the passed in properties to the properties of the Object
		$this->title = $title;
		$this->detail = $detail;
		$this->status = $status;
		$this->code = $status;
		$this->id = $id;
		$this->href = $href;
		$this->links = $links;
		$this->paths = $paths;

		// construct the parent CakeException class
		parent::__construct($this->title, $this->status);
	}

	/**
	 * magic method __call, checks if the method called is a property of the class,
	 * and returns the property if it is, else throws BadMethodCallException
	 *
	 * @param string $name [description]
	 * @param array $args [description]
	 * @return multi
	 * @throws BadMethodCallException if the Method and Property does not exist
	 */
	public function __call($name, $args) {
		if (property_exists($this, $name)) {
			return $this->{$name};
		}

		throw new BadMethodCallException("No method or property ::{$name} for this class");
	}

}

/**
 * ValidationBaseSerializerException
 *
 * a generic exception to use when validation errors occur
 */
class ValidationBaseSerializerException extends BaseSerializerException {

	/**
	 * A short, human-readable summary of the problem. It SHOULD NOT change from
	 * occurrence to occurrence of the problem, except for purposes of
	 * localization.
	 *
	 * @var string
	 */
	public $title = 'Base Validation Serializer Exception';

	/**
	 * The HTTP status code applicable to this problem, expressed as a string
	 * value, default is 422
	 *
	 * @var int
	 */
	public $status = 422;

	/**
	 * A CakePHP Model array of validation errors
	 *
	 * @var array
	 */
	public $validationErrors = array();

	/**
	 * Constructs a new instance of the base BaseJsonApiException
	 *
	 * @param string $title The title of the exception, passed to parent CakeException::__construct
	 * @param array $validationErrors A CakePHP Model array of validation errors
	 * @param int $status The http status code of the error, passed to parent CakeException::__construct
	 * @param string $id A unique identifier for this particular occurrence of the problem.
	 * @param string $href A URI that MAY yield further details about this particular occurrence of the problem.
	 * @param array $links An array of JSON Pointers [RFC6901] to the associated resource(s) within the request document [e.g. ["/data"] for a primary data object].
	 * @param array $paths An array of JSON Pointers to the relevant attribute(s) within the associated resource(s) in the request document. Each path MUST be relative to the resource path(s) expressed in the error object's "links" member [e.g. ["/first-name", "/last-name"] to reference a couple attributes].
	 */
	public function __construct(
		$title = 'Validation Failed',
		array $validationErrors = array(),
		$status = 422,
		$id = null,
		$href = null,
		$links = array(),
		$paths = array()
	) {
		$this->validationErrors = $validationErrors;
		parent::__construct($title, $validationErrors, $status, $id, $href, $links, $paths);
	}

	/**
	 * magic method __call, checks if the method called is a property of the class,
	 * and returns the property if it is, else throws BadMethodCallException
	 *
	 * @param string $name [description]
	 * @param array $args [description]
	 * @return multi
	 * @throws BadMethodCallException if the Method and Property does not exist
	 */
	public function __call($name, $args) {
		if (property_exists($this, $name)) {
			return $this->{$name};
		}

		throw new BadMethodCallException("No method or property ::{$name} for this class");
	}

}
