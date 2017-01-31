/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.l = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };

/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};

/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};

/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "./";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 44);
/******/ })
/************************************************************************/
/******/ ({

/***/ 0:
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*!
 * jQuery JavaScript Library v3.1.1
 * https://jquery.com/
 *
 * Includes Sizzle.js
 * https://sizzlejs.com/
 *
 * Copyright jQuery Foundation and other contributors
 * Released under the MIT license
 * https://jquery.org/license
 *
 * Date: 2016-09-22T22:30Z
 */
( function( global, factory ) {

	"use strict";

	if ( typeof module === "object" && typeof module.exports === "object" ) {

		// For CommonJS and CommonJS-like environments where a proper `window`
		// is present, execute the factory and get jQuery.
		// For environments that do not have a `window` with a `document`
		// (such as Node.js), expose a factory as module.exports.
		// This accentuates the need for the creation of a real `window`.
		// e.g. var jQuery = require("jquery")(window);
		// See ticket #14549 for more info.
		module.exports = global.document ?
			factory( global, true ) :
			function( w ) {
				if ( !w.document ) {
					throw new Error( "jQuery requires a window with a document" );
				}
				return factory( w );
			};
	} else {
		factory( global );
	}

// Pass this if window is not defined yet
} )( typeof window !== "undefined" ? window : this, function( window, noGlobal ) {

// Edge <= 12 - 13+, Firefox <=18 - 45+, IE 10 - 11, Safari 5.1 - 9+, iOS 6 - 9.1
// throw exceptions when non-strict code (e.g., ASP.NET 4.5) accesses strict mode
// arguments.callee.caller (trac-13335). But as of jQuery 3.0 (2016), strict mode should be common
// enough that all such attempts are guarded in a try block.
"use strict";

var arr = [];

var document = window.document;

var getProto = Object.getPrototypeOf;

var slice = arr.slice;

var concat = arr.concat;

var push = arr.push;

var indexOf = arr.indexOf;

var class2type = {};

var toString = class2type.toString;

var hasOwn = class2type.hasOwnProperty;

var fnToString = hasOwn.toString;

var ObjectFunctionString = fnToString.call( Object );

var support = {};



	function DOMEval( code, doc ) {
		doc = doc || document;

		var script = doc.createElement( "script" );

		script.text = code;
		doc.head.appendChild( script ).parentNode.removeChild( script );
	}
/* global Symbol */
// Defining this global in .eslintrc.json would create a danger of using the global
// unguarded in another place, it seems safer to define global only for this module



var
	version = "3.1.1",

	// Define a local copy of jQuery
	jQuery = function( selector, context ) {

		// The jQuery object is actually just the init constructor 'enhanced'
		// Need init if jQuery is called (just allow error to be thrown if not included)
		return new jQuery.fn.init( selector, context );
	},

	// Support: Android <=4.0 only
	// Make sure we trim BOM and NBSP
	rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,

	// Matches dashed string for camelizing
	rmsPrefix = /^-ms-/,
	rdashAlpha = /-([a-z])/g,

	// Used by jQuery.camelCase as callback to replace()
	fcamelCase = function( all, letter ) {
		return letter.toUpperCase();
	};

jQuery.fn = jQuery.prototype = {

	// The current version of jQuery being used
	jquery: version,

	constructor: jQuery,

	// The default length of a jQuery object is 0
	length: 0,

	toArray: function() {
		return slice.call( this );
	},

	// Get the Nth element in the matched element set OR
	// Get the whole matched element set as a clean array
	get: function( num ) {

		// Return all the elements in a clean array
		if ( num == null ) {
			return slice.call( this );
		}

		// Return just the one element from the set
		return num < 0 ? this[ num + this.length ] : this[ num ];
	},

	// Take an array of elements and push it onto the stack
	// (returning the new matched element set)
	pushStack: function( elems ) {

		// Build a new jQuery matched element set
		var ret = jQuery.merge( this.constructor(), elems );

		// Add the old object onto the stack (as a reference)
		ret.prevObject = this;

		// Return the newly-formed element set
		return ret;
	},

	// Execute a callback for every element in the matched set.
	each: function( callback ) {
		return jQuery.each( this, callback );
	},

	map: function( callback ) {
		return this.pushStack( jQuery.map( this, function( elem, i ) {
			return callback.call( elem, i, elem );
		} ) );
	},

	slice: function() {
		return this.pushStack( slice.apply( this, arguments ) );
	},

	first: function() {
		return this.eq( 0 );
	},

	last: function() {
		return this.eq( -1 );
	},

	eq: function( i ) {
		var len = this.length,
			j = +i + ( i < 0 ? len : 0 );
		return this.pushStack( j >= 0 && j < len ? [ this[ j ] ] : [] );
	},

	end: function() {
		return this.prevObject || this.constructor();
	},

	// For internal use only.
	// Behaves like an Array's method, not like a jQuery method.
	push: push,
	sort: arr.sort,
	splice: arr.splice
};

jQuery.extend = jQuery.fn.extend = function() {
	var options, name, src, copy, copyIsArray, clone,
		target = arguments[ 0 ] || {},
		i = 1,
		length = arguments.length,
		deep = false;

	// Handle a deep copy situation
	if ( typeof target === "boolean" ) {
		deep = target;

		// Skip the boolean and the target
		target = arguments[ i ] || {};
		i++;
	}

	// Handle case when target is a string or something (possible in deep copy)
	if ( typeof target !== "object" && !jQuery.isFunction( target ) ) {
		target = {};
	}

	// Extend jQuery itself if only one argument is passed
	if ( i === length ) {
		target = this;
		i--;
	}

	for ( ; i < length; i++ ) {

		// Only deal with non-null/undefined values
		if ( ( options = arguments[ i ] ) != null ) {

			// Extend the base object
			for ( name in options ) {
				src = target[ name ];
				copy = options[ name ];

				// Prevent never-ending loop
				if ( target === copy ) {
					continue;
				}

				// Recurse if we're merging plain objects or arrays
				if ( deep && copy && ( jQuery.isPlainObject( copy ) ||
					( copyIsArray = jQuery.isArray( copy ) ) ) ) {

					if ( copyIsArray ) {
						copyIsArray = false;
						clone = src && jQuery.isArray( src ) ? src : [];

					} else {
						clone = src && jQuery.isPlainObject( src ) ? src : {};
					}

					// Never move original objects, clone them
					target[ name ] = jQuery.extend( deep, clone, copy );

				// Don't bring in undefined values
				} else if ( copy !== undefined ) {
					target[ name ] = copy;
				}
			}
		}
	}

	// Return the modified object
	return target;
};

jQuery.extend( {

	// Unique for each copy of jQuery on the page
	expando: "jQuery" + ( version + Math.random() ).replace( /\D/g, "" ),

	// Assume jQuery is ready without the ready module
	isReady: true,

	error: function( msg ) {
		throw new Error( msg );
	},

	noop: function() {},

	isFunction: function( obj ) {
		return jQuery.type( obj ) === "function";
	},

	isArray: Array.isArray,

	isWindow: function( obj ) {
		return obj != null && obj === obj.window;
	},

	isNumeric: function( obj ) {

		// As of jQuery 3.0, isNumeric is limited to
		// strings and numbers (primitives or objects)
		// that can be coerced to finite numbers (gh-2662)
		var type = jQuery.type( obj );
		return ( type === "number" || type === "string" ) &&

			// parseFloat NaNs numeric-cast false positives ("")
			// ...but misinterprets leading-number strings, particularly hex literals ("0x...")
			// subtraction forces infinities to NaN
			!isNaN( obj - parseFloat( obj ) );
	},

	isPlainObject: function( obj ) {
		var proto, Ctor;

		// Detect obvious negatives
		// Use toString instead of jQuery.type to catch host objects
		if ( !obj || toString.call( obj ) !== "[object Object]" ) {
			return false;
		}

		proto = getProto( obj );

		// Objects with no prototype (e.g., `Object.create( null )`) are plain
		if ( !proto ) {
			return true;
		}

		// Objects with prototype are plain iff they were constructed by a global Object function
		Ctor = hasOwn.call( proto, "constructor" ) && proto.constructor;
		return typeof Ctor === "function" && fnToString.call( Ctor ) === ObjectFunctionString;
	},

	isEmptyObject: function( obj ) {

		/* eslint-disable no-unused-vars */
		// See https://github.com/eslint/eslint/issues/6125
		var name;

		for ( name in obj ) {
			return false;
		}
		return true;
	},

	type: function( obj ) {
		if ( obj == null ) {
			return obj + "";
		}

		// Support: Android <=2.3 only (functionish RegExp)
		return typeof obj === "object" || typeof obj === "function" ?
			class2type[ toString.call( obj ) ] || "object" :
			typeof obj;
	},

	// Evaluates a script in a global context
	globalEval: function( code ) {
		DOMEval( code );
	},

	// Convert dashed to camelCase; used by the css and data modules
	// Support: IE <=9 - 11, Edge 12 - 13
	// Microsoft forgot to hump their vendor prefix (#9572)
	camelCase: function( string ) {
		return string.replace( rmsPrefix, "ms-" ).replace( rdashAlpha, fcamelCase );
	},

	nodeName: function( elem, name ) {
		return elem.nodeName && elem.nodeName.toLowerCase() === name.toLowerCase();
	},

	each: function( obj, callback ) {
		var length, i = 0;

		if ( isArrayLike( obj ) ) {
			length = obj.length;
			for ( ; i < length; i++ ) {
				if ( callback.call( obj[ i ], i, obj[ i ] ) === false ) {
					break;
				}
			}
		} else {
			for ( i in obj ) {
				if ( callback.call( obj[ i ], i, obj[ i ] ) === false ) {
					break;
				}
			}
		}

		return obj;
	},

	// Support: Android <=4.0 only
	trim: function( text ) {
		return text == null ?
			"" :
			( text + "" ).replace( rtrim, "" );
	},

	// results is for internal usage only
	makeArray: function( arr, results ) {
		var ret = results || [];

		if ( arr != null ) {
			if ( isArrayLike( Object( arr ) ) ) {
				jQuery.merge( ret,
					typeof arr === "string" ?
					[ arr ] : arr
				);
			} else {
				push.call( ret, arr );
			}
		}

		return ret;
	},

	inArray: function( elem, arr, i ) {
		return arr == null ? -1 : indexOf.call( arr, elem, i );
	},

	// Support: Android <=4.0 only, PhantomJS 1 only
	// push.apply(_, arraylike) throws on ancient WebKit
	merge: function( first, second ) {
		var len = +second.length,
			j = 0,
			i = first.length;

		for ( ; j < len; j++ ) {
			first[ i++ ] = second[ j ];
		}

		first.length = i;

		return first;
	},

	grep: function( elems, callback, invert ) {
		var callbackInverse,
			matches = [],
			i = 0,
			length = elems.length,
			callbackExpect = !invert;

		// Go through the array, only saving the items
		// that pass the validator function
		for ( ; i < length; i++ ) {
			callbackInverse = !callback( elems[ i ], i );
			if ( callbackInverse !== callbackExpect ) {
				matches.push( elems[ i ] );
			}
		}

		return matches;
	},

	// arg is for internal usage only
	map: function( elems, callback, arg ) {
		var length, value,
			i = 0,
			ret = [];

		// Go through the array, translating each of the items to their new values
		if ( isArrayLike( elems ) ) {
			length = elems.length;
			for ( ; i < length; i++ ) {
				value = callback( elems[ i ], i, arg );

				if ( value != null ) {
					ret.push( value );
				}
			}

		// Go through every key on the object,
		} else {
			for ( i in elems ) {
				value = callback( elems[ i ], i, arg );

				if ( value != null ) {
					ret.push( value );
				}
			}
		}

		// Flatten any nested arrays
		return concat.apply( [], ret );
	},

	// A global GUID counter for objects
	guid: 1,

	// Bind a function to a context, optionally partially applying any
	// arguments.
	proxy: function( fn, context ) {
		var tmp, args, proxy;

		if ( typeof context === "string" ) {
			tmp = fn[ context ];
			context = fn;
			fn = tmp;
		}

		// Quick check to determine if target is callable, in the spec
		// this throws a TypeError, but we will just return undefined.
		if ( !jQuery.isFunction( fn ) ) {
			return undefined;
		}

		// Simulated bind
		args = slice.call( arguments, 2 );
		proxy = function() {
			return fn.apply( context || this, args.concat( slice.call( arguments ) ) );
		};

		// Set the guid of unique handler to the same of original handler, so it can be removed
		proxy.guid = fn.guid = fn.guid || jQuery.guid++;

		return proxy;
	},

	now: Date.now,

	// jQuery.support is not used in Core but other projects attach their
	// properties to it so it needs to exist.
	support: support
} );

if ( typeof Symbol === "function" ) {
	jQuery.fn[ Symbol.iterator ] = arr[ Symbol.iterator ];
}

// Populate the class2type map
jQuery.each( "Boolean Number String Function Array Date RegExp Object Error Symbol".split( " " ),
function( i, name ) {
	class2type[ "[object " + name + "]" ] = name.toLowerCase();
} );

function isArrayLike( obj ) {

	// Support: real iOS 8.2 only (not reproducible in simulator)
	// `in` check used to prevent JIT error (gh-2145)
	// hasOwn isn't used here due to false negatives
	// regarding Nodelist length in IE
	var length = !!obj && "length" in obj && obj.length,
		type = jQuery.type( obj );

	if ( type === "function" || jQuery.isWindow( obj ) ) {
		return false;
	}

	return type === "array" || length === 0 ||
		typeof length === "number" && length > 0 && ( length - 1 ) in obj;
}
var Sizzle =
/*!
 * Sizzle CSS Selector Engine v2.3.3
 * https://sizzlejs.com/
 *
 * Copyright jQuery Foundation and other contributors
 * Released under the MIT license
 * http://jquery.org/license
 *
 * Date: 2016-08-08
 */
(function( window ) {

var i,
	support,
	Expr,
	getText,
	isXML,
	tokenize,
	compile,
	select,
	outermostContext,
	sortInput,
	hasDuplicate,

	// Local document vars
	setDocument,
	document,
	docElem,
	documentIsHTML,
	rbuggyQSA,
	rbuggyMatches,
	matches,
	contains,

	// Instance-specific data
	expando = "sizzle" + 1 * new Date(),
	preferredDoc = window.document,
	dirruns = 0,
	done = 0,
	classCache = createCache(),
	tokenCache = createCache(),
	compilerCache = createCache(),
	sortOrder = function( a, b ) {
		if ( a === b ) {
			hasDuplicate = true;
		}
		return 0;
	},

	// Instance methods
	hasOwn = ({}).hasOwnProperty,
	arr = [],
	pop = arr.pop,
	push_native = arr.push,
	push = arr.push,
	slice = arr.slice,
	// Use a stripped-down indexOf as it's faster than native
	// https://jsperf.com/thor-indexof-vs-for/5
	indexOf = function( list, elem ) {
		var i = 0,
			len = list.length;
		for ( ; i < len; i++ ) {
			if ( list[i] === elem ) {
				return i;
			}
		}
		return -1;
	},

	booleans = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",

	// Regular expressions

	// http://www.w3.org/TR/css3-selectors/#whitespace
	whitespace = "[\\x20\\t\\r\\n\\f]",

	// http://www.w3.org/TR/CSS21/syndata.html#value-def-identifier
	identifier = "(?:\\\\.|[\\w-]|[^\0-\\xa0])+",

	// Attribute selectors: http://www.w3.org/TR/selectors/#attribute-selectors
	attributes = "\\[" + whitespace + "*(" + identifier + ")(?:" + whitespace +
		// Operator (capture 2)
		"*([*^$|!~]?=)" + whitespace +
		// "Attribute values must be CSS identifiers [capture 5] or strings [capture 3 or capture 4]"
		"*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + identifier + "))|)" + whitespace +
		"*\\]",

	pseudos = ":(" + identifier + ")(?:\\((" +
		// To reduce the number of selectors needing tokenize in the preFilter, prefer arguments:
		// 1. quoted (capture 3; capture 4 or capture 5)
		"('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|" +
		// 2. simple (capture 6)
		"((?:\\\\.|[^\\\\()[\\]]|" + attributes + ")*)|" +
		// 3. anything else (capture 2)
		".*" +
		")\\)|)",

	// Leading and non-escaped trailing whitespace, capturing some non-whitespace characters preceding the latter
	rwhitespace = new RegExp( whitespace + "+", "g" ),
	rtrim = new RegExp( "^" + whitespace + "+|((?:^|[^\\\\])(?:\\\\.)*)" + whitespace + "+$", "g" ),

	rcomma = new RegExp( "^" + whitespace + "*," + whitespace + "*" ),
	rcombinators = new RegExp( "^" + whitespace + "*([>+~]|" + whitespace + ")" + whitespace + "*" ),

	rattributeQuotes = new RegExp( "=" + whitespace + "*([^\\]'\"]*?)" + whitespace + "*\\]", "g" ),

	rpseudo = new RegExp( pseudos ),
	ridentifier = new RegExp( "^" + identifier + "$" ),

	matchExpr = {
		"ID": new RegExp( "^#(" + identifier + ")" ),
		"CLASS": new RegExp( "^\\.(" + identifier + ")" ),
		"TAG": new RegExp( "^(" + identifier + "|[*])" ),
		"ATTR": new RegExp( "^" + attributes ),
		"PSEUDO": new RegExp( "^" + pseudos ),
		"CHILD": new RegExp( "^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + whitespace +
			"*(even|odd|(([+-]|)(\\d*)n|)" + whitespace + "*(?:([+-]|)" + whitespace +
			"*(\\d+)|))" + whitespace + "*\\)|)", "i" ),
		"bool": new RegExp( "^(?:" + booleans + ")$", "i" ),
		// For use in libraries implementing .is()
		// We use this for POS matching in `select`
		"needsContext": new RegExp( "^" + whitespace + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" +
			whitespace + "*((?:-\\d)?\\d*)" + whitespace + "*\\)|)(?=[^-]|$)", "i" )
	},

	rinputs = /^(?:input|select|textarea|button)$/i,
	rheader = /^h\d$/i,

	rnative = /^[^{]+\{\s*\[native \w/,

	// Easily-parseable/retrievable ID or TAG or CLASS selectors
	rquickExpr = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,

	rsibling = /[+~]/,

	// CSS escapes
	// http://www.w3.org/TR/CSS21/syndata.html#escaped-characters
	runescape = new RegExp( "\\\\([\\da-f]{1,6}" + whitespace + "?|(" + whitespace + ")|.)", "ig" ),
	funescape = function( _, escaped, escapedWhitespace ) {
		var high = "0x" + escaped - 0x10000;
		// NaN means non-codepoint
		// Support: Firefox<24
		// Workaround erroneous numeric interpretation of +"0x"
		return high !== high || escapedWhitespace ?
			escaped :
			high < 0 ?
				// BMP codepoint
				String.fromCharCode( high + 0x10000 ) :
				// Supplemental Plane codepoint (surrogate pair)
				String.fromCharCode( high >> 10 | 0xD800, high & 0x3FF | 0xDC00 );
	},

	// CSS string/identifier serialization
	// https://drafts.csswg.org/cssom/#common-serializing-idioms
	rcssescape = /([\0-\x1f\x7f]|^-?\d)|^-$|[^\0-\x1f\x7f-\uFFFF\w-]/g,
	fcssescape = function( ch, asCodePoint ) {
		if ( asCodePoint ) {

			// U+0000 NULL becomes U+FFFD REPLACEMENT CHARACTER
			if ( ch === "\0" ) {
				return "\uFFFD";
			}

			// Control characters and (dependent upon position) numbers get escaped as code points
			return ch.slice( 0, -1 ) + "\\" + ch.charCodeAt( ch.length - 1 ).toString( 16 ) + " ";
		}

		// Other potentially-special ASCII characters get backslash-escaped
		return "\\" + ch;
	},

	// Used for iframes
	// See setDocument()
	// Removing the function wrapper causes a "Permission Denied"
	// error in IE
	unloadHandler = function() {
		setDocument();
	},

	disabledAncestor = addCombinator(
		function( elem ) {
			return elem.disabled === true && ("form" in elem || "label" in elem);
		},
		{ dir: "parentNode", next: "legend" }
	);

// Optimize for push.apply( _, NodeList )
try {
	push.apply(
		(arr = slice.call( preferredDoc.childNodes )),
		preferredDoc.childNodes
	);
	// Support: Android<4.0
	// Detect silently failing push.apply
	arr[ preferredDoc.childNodes.length ].nodeType;
} catch ( e ) {
	push = { apply: arr.length ?

		// Leverage slice if possible
		function( target, els ) {
			push_native.apply( target, slice.call(els) );
		} :

		// Support: IE<9
		// Otherwise append directly
		function( target, els ) {
			var j = target.length,
				i = 0;
			// Can't trust NodeList.length
			while ( (target[j++] = els[i++]) ) {}
			target.length = j - 1;
		}
	};
}

function Sizzle( selector, context, results, seed ) {
	var m, i, elem, nid, match, groups, newSelector,
		newContext = context && context.ownerDocument,

		// nodeType defaults to 9, since context defaults to document
		nodeType = context ? context.nodeType : 9;

	results = results || [];

	// Return early from calls with invalid selector or context
	if ( typeof selector !== "string" || !selector ||
		nodeType !== 1 && nodeType !== 9 && nodeType !== 11 ) {

		return results;
	}

	// Try to shortcut find operations (as opposed to filters) in HTML documents
	if ( !seed ) {

		if ( ( context ? context.ownerDocument || context : preferredDoc ) !== document ) {
			setDocument( context );
		}
		context = context || document;

		if ( documentIsHTML ) {

			// If the selector is sufficiently simple, try using a "get*By*" DOM method
			// (excepting DocumentFragment context, where the methods don't exist)
			if ( nodeType !== 11 && (match = rquickExpr.exec( selector )) ) {

				// ID selector
				if ( (m = match[1]) ) {

					// Document context
					if ( nodeType === 9 ) {
						if ( (elem = context.getElementById( m )) ) {

							// Support: IE, Opera, Webkit
							// TODO: identify versions
							// getElementById can match elements by name instead of ID
							if ( elem.id === m ) {
								results.push( elem );
								return results;
							}
						} else {
							return results;
						}

					// Element context
					} else {

						// Support: IE, Opera, Webkit
						// TODO: identify versions
						// getElementById can match elements by name instead of ID
						if ( newContext && (elem = newContext.getElementById( m )) &&
							contains( context, elem ) &&
							elem.id === m ) {

							results.push( elem );
							return results;
						}
					}

				// Type selector
				} else if ( match[2] ) {
					push.apply( results, context.getElementsByTagName( selector ) );
					return results;

				// Class selector
				} else if ( (m = match[3]) && support.getElementsByClassName &&
					context.getElementsByClassName ) {

					push.apply( results, context.getElementsByClassName( m ) );
					return results;
				}
			}

			// Take advantage of querySelectorAll
			if ( support.qsa &&
				!compilerCache[ selector + " " ] &&
				(!rbuggyQSA || !rbuggyQSA.test( selector )) ) {

				if ( nodeType !== 1 ) {
					newContext = context;
					newSelector = selector;

				// qSA looks outside Element context, which is not what we want
				// Thanks to Andrew Dupont for this workaround technique
				// Support: IE <=8
				// Exclude object elements
				} else if ( context.nodeName.toLowerCase() !== "object" ) {

					// Capture the context ID, setting it first if necessary
					if ( (nid = context.getAttribute( "id" )) ) {
						nid = nid.replace( rcssescape, fcssescape );
					} else {
						context.setAttribute( "id", (nid = expando) );
					}

					// Prefix every selector in the list
					groups = tokenize( selector );
					i = groups.length;
					while ( i-- ) {
						groups[i] = "#" + nid + " " + toSelector( groups[i] );
					}
					newSelector = groups.join( "," );

					// Expand context for sibling selectors
					newContext = rsibling.test( selector ) && testContext( context.parentNode ) ||
						context;
				}

				if ( newSelector ) {
					try {
						push.apply( results,
							newContext.querySelectorAll( newSelector )
						);
						return results;
					} catch ( qsaError ) {
					} finally {
						if ( nid === expando ) {
							context.removeAttribute( "id" );
						}
					}
				}
			}
		}
	}

	// All others
	return select( selector.replace( rtrim, "$1" ), context, results, seed );
}

/**
 * Create key-value caches of limited size
 * @returns {function(string, object)} Returns the Object data after storing it on itself with
 *	property name the (space-suffixed) string and (if the cache is larger than Expr.cacheLength)
 *	deleting the oldest entry
 */
function createCache() {
	var keys = [];

	function cache( key, value ) {
		// Use (key + " ") to avoid collision with native prototype properties (see Issue #157)
		if ( keys.push( key + " " ) > Expr.cacheLength ) {
			// Only keep the most recent entries
			delete cache[ keys.shift() ];
		}
		return (cache[ key + " " ] = value);
	}
	return cache;
}

/**
 * Mark a function for special use by Sizzle
 * @param {Function} fn The function to mark
 */
function markFunction( fn ) {
	fn[ expando ] = true;
	return fn;
}

/**
 * Support testing using an element
 * @param {Function} fn Passed the created element and returns a boolean result
 */
function assert( fn ) {
	var el = document.createElement("fieldset");

	try {
		return !!fn( el );
	} catch (e) {
		return false;
	} finally {
		// Remove from its parent by default
		if ( el.parentNode ) {
			el.parentNode.removeChild( el );
		}
		// release memory in IE
		el = null;
	}
}

/**
 * Adds the same handler for all of the specified attrs
 * @param {String} attrs Pipe-separated list of attributes
 * @param {Function} handler The method that will be applied
 */
function addHandle( attrs, handler ) {
	var arr = attrs.split("|"),
		i = arr.length;

	while ( i-- ) {
		Expr.attrHandle[ arr[i] ] = handler;
	}
}

/**
 * Checks document order of two siblings
 * @param {Element} a
 * @param {Element} b
 * @returns {Number} Returns less than 0 if a precedes b, greater than 0 if a follows b
 */
function siblingCheck( a, b ) {
	var cur = b && a,
		diff = cur && a.nodeType === 1 && b.nodeType === 1 &&
			a.sourceIndex - b.sourceIndex;

	// Use IE sourceIndex if available on both nodes
	if ( diff ) {
		return diff;
	}

	// Check if b follows a
	if ( cur ) {
		while ( (cur = cur.nextSibling) ) {
			if ( cur === b ) {
				return -1;
			}
		}
	}

	return a ? 1 : -1;
}

/**
 * Returns a function to use in pseudos for input types
 * @param {String} type
 */
function createInputPseudo( type ) {
	return function( elem ) {
		var name = elem.nodeName.toLowerCase();
		return name === "input" && elem.type === type;
	};
}

/**
 * Returns a function to use in pseudos for buttons
 * @param {String} type
 */
function createButtonPseudo( type ) {
	return function( elem ) {
		var name = elem.nodeName.toLowerCase();
		return (name === "input" || name === "button") && elem.type === type;
	};
}

/**
 * Returns a function to use in pseudos for :enabled/:disabled
 * @param {Boolean} disabled true for :disabled; false for :enabled
 */
function createDisabledPseudo( disabled ) {

	// Known :disabled false positives: fieldset[disabled] > legend:nth-of-type(n+2) :can-disable
	return function( elem ) {

		// Only certain elements can match :enabled or :disabled
		// https://html.spec.whatwg.org/multipage/scripting.html#selector-enabled
		// https://html.spec.whatwg.org/multipage/scripting.html#selector-disabled
		if ( "form" in elem ) {

			// Check for inherited disabledness on relevant non-disabled elements:
			// * listed form-associated elements in a disabled fieldset
			//   https://html.spec.whatwg.org/multipage/forms.html#category-listed
			//   https://html.spec.whatwg.org/multipage/forms.html#concept-fe-disabled
			// * option elements in a disabled optgroup
			//   https://html.spec.whatwg.org/multipage/forms.html#concept-option-disabled
			// All such elements have a "form" property.
			if ( elem.parentNode && elem.disabled === false ) {

				// Option elements defer to a parent optgroup if present
				if ( "label" in elem ) {
					if ( "label" in elem.parentNode ) {
						return elem.parentNode.disabled === disabled;
					} else {
						return elem.disabled === disabled;
					}
				}

				// Support: IE 6 - 11
				// Use the isDisabled shortcut property to check for disabled fieldset ancestors
				return elem.isDisabled === disabled ||

					// Where there is no isDisabled, check manually
					/* jshint -W018 */
					elem.isDisabled !== !disabled &&
						disabledAncestor( elem ) === disabled;
			}

			return elem.disabled === disabled;

		// Try to winnow out elements that can't be disabled before trusting the disabled property.
		// Some victims get caught in our net (label, legend, menu, track), but it shouldn't
		// even exist on them, let alone have a boolean value.
		} else if ( "label" in elem ) {
			return elem.disabled === disabled;
		}

		// Remaining elements are neither :enabled nor :disabled
		return false;
	};
}

/**
 * Returns a function to use in pseudos for positionals
 * @param {Function} fn
 */
function createPositionalPseudo( fn ) {
	return markFunction(function( argument ) {
		argument = +argument;
		return markFunction(function( seed, matches ) {
			var j,
				matchIndexes = fn( [], seed.length, argument ),
				i = matchIndexes.length;

			// Match elements found at the specified indexes
			while ( i-- ) {
				if ( seed[ (j = matchIndexes[i]) ] ) {
					seed[j] = !(matches[j] = seed[j]);
				}
			}
		});
	});
}

/**
 * Checks a node for validity as a Sizzle context
 * @param {Element|Object=} context
 * @returns {Element|Object|Boolean} The input node if acceptable, otherwise a falsy value
 */
function testContext( context ) {
	return context && typeof context.getElementsByTagName !== "undefined" && context;
}

// Expose support vars for convenience
support = Sizzle.support = {};

/**
 * Detects XML nodes
 * @param {Element|Object} elem An element or a document
 * @returns {Boolean} True iff elem is a non-HTML XML node
 */
isXML = Sizzle.isXML = function( elem ) {
	// documentElement is verified for cases where it doesn't yet exist
	// (such as loading iframes in IE - #4833)
	var documentElement = elem && (elem.ownerDocument || elem).documentElement;
	return documentElement ? documentElement.nodeName !== "HTML" : false;
};

/**
 * Sets document-related variables once based on the current document
 * @param {Element|Object} [doc] An element or document object to use to set the document
 * @returns {Object} Returns the current document
 */
setDocument = Sizzle.setDocument = function( node ) {
	var hasCompare, subWindow,
		doc = node ? node.ownerDocument || node : preferredDoc;

	// Return early if doc is invalid or already selected
	if ( doc === document || doc.nodeType !== 9 || !doc.documentElement ) {
		return document;
	}

	// Update global variables
	document = doc;
	docElem = document.documentElement;
	documentIsHTML = !isXML( document );

	// Support: IE 9-11, Edge
	// Accessing iframe documents after unload throws "permission denied" errors (jQuery #13936)
	if ( preferredDoc !== document &&
		(subWindow = document.defaultView) && subWindow.top !== subWindow ) {

		// Support: IE 11, Edge
		if ( subWindow.addEventListener ) {
			subWindow.addEventListener( "unload", unloadHandler, false );

		// Support: IE 9 - 10 only
		} else if ( subWindow.attachEvent ) {
			subWindow.attachEvent( "onunload", unloadHandler );
		}
	}

	/* Attributes
	---------------------------------------------------------------------- */

	// Support: IE<8
	// Verify that getAttribute really returns attributes and not properties
	// (excepting IE8 booleans)
	support.attributes = assert(function( el ) {
		el.className = "i";
		return !el.getAttribute("className");
	});

	/* getElement(s)By*
	---------------------------------------------------------------------- */

	// Check if getElementsByTagName("*") returns only elements
	support.getElementsByTagName = assert(function( el ) {
		el.appendChild( document.createComment("") );
		return !el.getElementsByTagName("*").length;
	});

	// Support: IE<9
	support.getElementsByClassName = rnative.test( document.getElementsByClassName );

	// Support: IE<10
	// Check if getElementById returns elements by name
	// The broken getElementById methods don't pick up programmatically-set names,
	// so use a roundabout getElementsByName test
	support.getById = assert(function( el ) {
		docElem.appendChild( el ).id = expando;
		return !document.getElementsByName || !document.getElementsByName( expando ).length;
	});

	// ID filter and find
	if ( support.getById ) {
		Expr.filter["ID"] = function( id ) {
			var attrId = id.replace( runescape, funescape );
			return function( elem ) {
				return elem.getAttribute("id") === attrId;
			};
		};
		Expr.find["ID"] = function( id, context ) {
			if ( typeof context.getElementById !== "undefined" && documentIsHTML ) {
				var elem = context.getElementById( id );
				return elem ? [ elem ] : [];
			}
		};
	} else {
		Expr.filter["ID"] =  function( id ) {
			var attrId = id.replace( runescape, funescape );
			return function( elem ) {
				var node = typeof elem.getAttributeNode !== "undefined" &&
					elem.getAttributeNode("id");
				return node && node.value === attrId;
			};
		};

		// Support: IE 6 - 7 only
		// getElementById is not reliable as a find shortcut
		Expr.find["ID"] = function( id, context ) {
			if ( typeof context.getElementById !== "undefined" && documentIsHTML ) {
				var node, i, elems,
					elem = context.getElementById( id );

				if ( elem ) {

					// Verify the id attribute
					node = elem.getAttributeNode("id");
					if ( node && node.value === id ) {
						return [ elem ];
					}

					// Fall back on getElementsByName
					elems = context.getElementsByName( id );
					i = 0;
					while ( (elem = elems[i++]) ) {
						node = elem.getAttributeNode("id");
						if ( node && node.value === id ) {
							return [ elem ];
						}
					}
				}

				return [];
			}
		};
	}

	// Tag
	Expr.find["TAG"] = support.getElementsByTagName ?
		function( tag, context ) {
			if ( typeof context.getElementsByTagName !== "undefined" ) {
				return context.getElementsByTagName( tag );

			// DocumentFragment nodes don't have gEBTN
			} else if ( support.qsa ) {
				return context.querySelectorAll( tag );
			}
		} :

		function( tag, context ) {
			var elem,
				tmp = [],
				i = 0,
				// By happy coincidence, a (broken) gEBTN appears on DocumentFragment nodes too
				results = context.getElementsByTagName( tag );

			// Filter out possible comments
			if ( tag === "*" ) {
				while ( (elem = results[i++]) ) {
					if ( elem.nodeType === 1 ) {
						tmp.push( elem );
					}
				}

				return tmp;
			}
			return results;
		};

	// Class
	Expr.find["CLASS"] = support.getElementsByClassName && function( className, context ) {
		if ( typeof context.getElementsByClassName !== "undefined" && documentIsHTML ) {
			return context.getElementsByClassName( className );
		}
	};

	/* QSA/matchesSelector
	---------------------------------------------------------------------- */

	// QSA and matchesSelector support

	// matchesSelector(:active) reports false when true (IE9/Opera 11.5)
	rbuggyMatches = [];

	// qSa(:focus) reports false when true (Chrome 21)
	// We allow this because of a bug in IE8/9 that throws an error
	// whenever `document.activeElement` is accessed on an iframe
	// So, we allow :focus to pass through QSA all the time to avoid the IE error
	// See https://bugs.jquery.com/ticket/13378
	rbuggyQSA = [];

	if ( (support.qsa = rnative.test( document.querySelectorAll )) ) {
		// Build QSA regex
		// Regex strategy adopted from Diego Perini
		assert(function( el ) {
			// Select is set to empty string on purpose
			// This is to test IE's treatment of not explicitly
			// setting a boolean content attribute,
			// since its presence should be enough
			// https://bugs.jquery.com/ticket/12359
			docElem.appendChild( el ).innerHTML = "<a id='" + expando + "'></a>" +
				"<select id='" + expando + "-\r\\' msallowcapture=''>" +
				"<option selected=''></option></select>";

			// Support: IE8, Opera 11-12.16
			// Nothing should be selected when empty strings follow ^= or $= or *=
			// The test attribute must be unknown in Opera but "safe" for WinRT
			// https://msdn.microsoft.com/en-us/library/ie/hh465388.aspx#attribute_section
			if ( el.querySelectorAll("[msallowcapture^='']").length ) {
				rbuggyQSA.push( "[*^$]=" + whitespace + "*(?:''|\"\")" );
			}

			// Support: IE8
			// Boolean attributes and "value" are not treated correctly
			if ( !el.querySelectorAll("[selected]").length ) {
				rbuggyQSA.push( "\\[" + whitespace + "*(?:value|" + booleans + ")" );
			}

			// Support: Chrome<29, Android<4.4, Safari<7.0+, iOS<7.0+, PhantomJS<1.9.8+
			if ( !el.querySelectorAll( "[id~=" + expando + "-]" ).length ) {
				rbuggyQSA.push("~=");
			}

			// Webkit/Opera - :checked should return selected option elements
			// http://www.w3.org/TR/2011/REC-css3-selectors-20110929/#checked
			// IE8 throws error here and will not see later tests
			if ( !el.querySelectorAll(":checked").length ) {
				rbuggyQSA.push(":checked");
			}

			// Support: Safari 8+, iOS 8+
			// https://bugs.webkit.org/show_bug.cgi?id=136851
			// In-page `selector#id sibling-combinator selector` fails
			if ( !el.querySelectorAll( "a#" + expando + "+*" ).length ) {
				rbuggyQSA.push(".#.+[+~]");
			}
		});

		assert(function( el ) {
			el.innerHTML = "<a href='' disabled='disabled'></a>" +
				"<select disabled='disabled'><option/></select>";

			// Support: Windows 8 Native Apps
			// The type and name attributes are restricted during .innerHTML assignment
			var input = document.createElement("input");
			input.setAttribute( "type", "hidden" );
			el.appendChild( input ).setAttribute( "name", "D" );

			// Support: IE8
			// Enforce case-sensitivity of name attribute
			if ( el.querySelectorAll("[name=d]").length ) {
				rbuggyQSA.push( "name" + whitespace + "*[*^$|!~]?=" );
			}

			// FF 3.5 - :enabled/:disabled and hidden elements (hidden elements are still enabled)
			// IE8 throws error here and will not see later tests
			if ( el.querySelectorAll(":enabled").length !== 2 ) {
				rbuggyQSA.push( ":enabled", ":disabled" );
			}

			// Support: IE9-11+
			// IE's :disabled selector does not pick up the children of disabled fieldsets
			docElem.appendChild( el ).disabled = true;
			if ( el.querySelectorAll(":disabled").length !== 2 ) {
				rbuggyQSA.push( ":enabled", ":disabled" );
			}

			// Opera 10-11 does not throw on post-comma invalid pseudos
			el.querySelectorAll("*,:x");
			rbuggyQSA.push(",.*:");
		});
	}

	if ( (support.matchesSelector = rnative.test( (matches = docElem.matches ||
		docElem.webkitMatchesSelector ||
		docElem.mozMatchesSelector ||
		docElem.oMatchesSelector ||
		docElem.msMatchesSelector) )) ) {

		assert(function( el ) {
			// Check to see if it's possible to do matchesSelector
			// on a disconnected node (IE 9)
			support.disconnectedMatch = matches.call( el, "*" );

			// This should fail with an exception
			// Gecko does not error, returns false instead
			matches.call( el, "[s!='']:x" );
			rbuggyMatches.push( "!=", pseudos );
		});
	}

	rbuggyQSA = rbuggyQSA.length && new RegExp( rbuggyQSA.join("|") );
	rbuggyMatches = rbuggyMatches.length && new RegExp( rbuggyMatches.join("|") );

	/* Contains
	---------------------------------------------------------------------- */
	hasCompare = rnative.test( docElem.compareDocumentPosition );

	// Element contains another
	// Purposefully self-exclusive
	// As in, an element does not contain itself
	contains = hasCompare || rnative.test( docElem.contains ) ?
		function( a, b ) {
			var adown = a.nodeType === 9 ? a.documentElement : a,
				bup = b && b.parentNode;
			return a === bup || !!( bup && bup.nodeType === 1 && (
				adown.contains ?
					adown.contains( bup ) :
					a.compareDocumentPosition && a.compareDocumentPosition( bup ) & 16
			));
		} :
		function( a, b ) {
			if ( b ) {
				while ( (b = b.parentNode) ) {
					if ( b === a ) {
						return true;
					}
				}
			}
			return false;
		};

	/* Sorting
	---------------------------------------------------------------------- */

	// Document order sorting
	sortOrder = hasCompare ?
	function( a, b ) {

		// Flag for duplicate removal
		if ( a === b ) {
			hasDuplicate = true;
			return 0;
		}

		// Sort on method existence if only one input has compareDocumentPosition
		var compare = !a.compareDocumentPosition - !b.compareDocumentPosition;
		if ( compare ) {
			return compare;
		}

		// Calculate position if both inputs belong to the same document
		compare = ( a.ownerDocument || a ) === ( b.ownerDocument || b ) ?
			a.compareDocumentPosition( b ) :

			// Otherwise we know they are disconnected
			1;

		// Disconnected nodes
		if ( compare & 1 ||
			(!support.sortDetached && b.compareDocumentPosition( a ) === compare) ) {

			// Choose the first element that is related to our preferred document
			if ( a === document || a.ownerDocument === preferredDoc && contains(preferredDoc, a) ) {
				return -1;
			}
			if ( b === document || b.ownerDocument === preferredDoc && contains(preferredDoc, b) ) {
				return 1;
			}

			// Maintain original order
			return sortInput ?
				( indexOf( sortInput, a ) - indexOf( sortInput, b ) ) :
				0;
		}

		return compare & 4 ? -1 : 1;
	} :
	function( a, b ) {
		// Exit early if the nodes are identical
		if ( a === b ) {
			hasDuplicate = true;
			return 0;
		}

		var cur,
			i = 0,
			aup = a.parentNode,
			bup = b.parentNode,
			ap = [ a ],
			bp = [ b ];

		// Parentless nodes are either documents or disconnected
		if ( !aup || !bup ) {
			return a === document ? -1 :
				b === document ? 1 :
				aup ? -1 :
				bup ? 1 :
				sortInput ?
				( indexOf( sortInput, a ) - indexOf( sortInput, b ) ) :
				0;

		// If the nodes are siblings, we can do a quick check
		} else if ( aup === bup ) {
			return siblingCheck( a, b );
		}

		// Otherwise we need full lists of their ancestors for comparison
		cur = a;
		while ( (cur = cur.parentNode) ) {
			ap.unshift( cur );
		}
		cur = b;
		while ( (cur = cur.parentNode) ) {
			bp.unshift( cur );
		}

		// Walk down the tree looking for a discrepancy
		while ( ap[i] === bp[i] ) {
			i++;
		}

		return i ?
			// Do a sibling check if the nodes have a common ancestor
			siblingCheck( ap[i], bp[i] ) :

			// Otherwise nodes in our document sort first
			ap[i] === preferredDoc ? -1 :
			bp[i] === preferredDoc ? 1 :
			0;
	};

	return document;
};

Sizzle.matches = function( expr, elements ) {
	return Sizzle( expr, null, null, elements );
};

Sizzle.matchesSelector = function( elem, expr ) {
	// Set document vars if needed
	if ( ( elem.ownerDocument || elem ) !== document ) {
		setDocument( elem );
	}

	// Make sure that attribute selectors are quoted
	expr = expr.replace( rattributeQuotes, "='$1']" );

	if ( support.matchesSelector && documentIsHTML &&
		!compilerCache[ expr + " " ] &&
		( !rbuggyMatches || !rbuggyMatches.test( expr ) ) &&
		( !rbuggyQSA     || !rbuggyQSA.test( expr ) ) ) {

		try {
			var ret = matches.call( elem, expr );

			// IE 9's matchesSelector returns false on disconnected nodes
			if ( ret || support.disconnectedMatch ||
					// As well, disconnected nodes are said to be in a document
					// fragment in IE 9
					elem.document && elem.document.nodeType !== 11 ) {
				return ret;
			}
		} catch (e) {}
	}

	return Sizzle( expr, document, null, [ elem ] ).length > 0;
};

Sizzle.contains = function( context, elem ) {
	// Set document vars if needed
	if ( ( context.ownerDocument || context ) !== document ) {
		setDocument( context );
	}
	return contains( context, elem );
};

Sizzle.attr = function( elem, name ) {
	// Set document vars if needed
	if ( ( elem.ownerDocument || elem ) !== document ) {
		setDocument( elem );
	}

	var fn = Expr.attrHandle[ name.toLowerCase() ],
		// Don't get fooled by Object.prototype properties (jQuery #13807)
		val = fn && hasOwn.call( Expr.attrHandle, name.toLowerCase() ) ?
			fn( elem, name, !documentIsHTML ) :
			undefined;

	return val !== undefined ?
		val :
		support.attributes || !documentIsHTML ?
			elem.getAttribute( name ) :
			(val = elem.getAttributeNode(name)) && val.specified ?
				val.value :
				null;
};

Sizzle.escape = function( sel ) {
	return (sel + "").replace( rcssescape, fcssescape );
};

Sizzle.error = function( msg ) {
	throw new Error( "Syntax error, unrecognized expression: " + msg );
};

/**
 * Document sorting and removing duplicates
 * @param {ArrayLike} results
 */
Sizzle.uniqueSort = function( results ) {
	var elem,
		duplicates = [],
		j = 0,
		i = 0;

	// Unless we *know* we can detect duplicates, assume their presence
	hasDuplicate = !support.detectDuplicates;
	sortInput = !support.sortStable && results.slice( 0 );
	results.sort( sortOrder );

	if ( hasDuplicate ) {
		while ( (elem = results[i++]) ) {
			if ( elem === results[ i ] ) {
				j = duplicates.push( i );
			}
		}
		while ( j-- ) {
			results.splice( duplicates[ j ], 1 );
		}
	}

	// Clear input after sorting to release objects
	// See https://github.com/jquery/sizzle/pull/225
	sortInput = null;

	return results;
};

/**
 * Utility function for retrieving the text value of an array of DOM nodes
 * @param {Array|Element} elem
 */
getText = Sizzle.getText = function( elem ) {
	var node,
		ret = "",
		i = 0,
		nodeType = elem.nodeType;

	if ( !nodeType ) {
		// If no nodeType, this is expected to be an array
		while ( (node = elem[i++]) ) {
			// Do not traverse comment nodes
			ret += getText( node );
		}
	} else if ( nodeType === 1 || nodeType === 9 || nodeType === 11 ) {
		// Use textContent for elements
		// innerText usage removed for consistency of new lines (jQuery #11153)
		if ( typeof elem.textContent === "string" ) {
			return elem.textContent;
		} else {
			// Traverse its children
			for ( elem = elem.firstChild; elem; elem = elem.nextSibling ) {
				ret += getText( elem );
			}
		}
	} else if ( nodeType === 3 || nodeType === 4 ) {
		return elem.nodeValue;
	}
	// Do not include comment or processing instruction nodes

	return ret;
};

Expr = Sizzle.selectors = {

	// Can be adjusted by the user
	cacheLength: 50,

	createPseudo: markFunction,

	match: matchExpr,

	attrHandle: {},

	find: {},

	relative: {
		">": { dir: "parentNode", first: true },
		" ": { dir: "parentNode" },
		"+": { dir: "previousSibling", first: true },
		"~": { dir: "previousSibling" }
	},

	preFilter: {
		"ATTR": function( match ) {
			match[1] = match[1].replace( runescape, funescape );

			// Move the given value to match[3] whether quoted or unquoted
			match[3] = ( match[3] || match[4] || match[5] || "" ).replace( runescape, funescape );

			if ( match[2] === "~=" ) {
				match[3] = " " + match[3] + " ";
			}

			return match.slice( 0, 4 );
		},

		"CHILD": function( match ) {
			/* matches from matchExpr["CHILD"]
				1 type (only|nth|...)
				2 what (child|of-type)
				3 argument (even|odd|\d*|\d*n([+-]\d+)?|...)
				4 xn-component of xn+y argument ([+-]?\d*n|)
				5 sign of xn-component
				6 x of xn-component
				7 sign of y-component
				8 y of y-component
			*/
			match[1] = match[1].toLowerCase();

			if ( match[1].slice( 0, 3 ) === "nth" ) {
				// nth-* requires argument
				if ( !match[3] ) {
					Sizzle.error( match[0] );
				}

				// numeric x and y parameters for Expr.filter.CHILD
				// remember that false/true cast respectively to 0/1
				match[4] = +( match[4] ? match[5] + (match[6] || 1) : 2 * ( match[3] === "even" || match[3] === "odd" ) );
				match[5] = +( ( match[7] + match[8] ) || match[3] === "odd" );

			// other types prohibit arguments
			} else if ( match[3] ) {
				Sizzle.error( match[0] );
			}

			return match;
		},

		"PSEUDO": function( match ) {
			var excess,
				unquoted = !match[6] && match[2];

			if ( matchExpr["CHILD"].test( match[0] ) ) {
				return null;
			}

			// Accept quoted arguments as-is
			if ( match[3] ) {
				match[2] = match[4] || match[5] || "";

			// Strip excess characters from unquoted arguments
			} else if ( unquoted && rpseudo.test( unquoted ) &&
				// Get excess from tokenize (recursively)
				(excess = tokenize( unquoted, true )) &&
				// advance to the next closing parenthesis
				(excess = unquoted.indexOf( ")", unquoted.length - excess ) - unquoted.length) ) {

				// excess is a negative index
				match[0] = match[0].slice( 0, excess );
				match[2] = unquoted.slice( 0, excess );
			}

			// Return only captures needed by the pseudo filter method (type and argument)
			return match.slice( 0, 3 );
		}
	},

	filter: {

		"TAG": function( nodeNameSelector ) {
			var nodeName = nodeNameSelector.replace( runescape, funescape ).toLowerCase();
			return nodeNameSelector === "*" ?
				function() { return true; } :
				function( elem ) {
					return elem.nodeName && elem.nodeName.toLowerCase() === nodeName;
				};
		},

		"CLASS": function( className ) {
			var pattern = classCache[ className + " " ];

			return pattern ||
				(pattern = new RegExp( "(^|" + whitespace + ")" + className + "(" + whitespace + "|$)" )) &&
				classCache( className, function( elem ) {
					return pattern.test( typeof elem.className === "string" && elem.className || typeof elem.getAttribute !== "undefined" && elem.getAttribute("class") || "" );
				});
		},

		"ATTR": function( name, operator, check ) {
			return function( elem ) {
				var result = Sizzle.attr( elem, name );

				if ( result == null ) {
					return operator === "!=";
				}
				if ( !operator ) {
					return true;
				}

				result += "";

				return operator === "=" ? result === check :
					operator === "!=" ? result !== check :
					operator === "^=" ? check && result.indexOf( check ) === 0 :
					operator === "*=" ? check && result.indexOf( check ) > -1 :
					operator === "$=" ? check && result.slice( -check.length ) === check :
					operator === "~=" ? ( " " + result.replace( rwhitespace, " " ) + " " ).indexOf( check ) > -1 :
					operator === "|=" ? result === check || result.slice( 0, check.length + 1 ) === check + "-" :
					false;
			};
		},

		"CHILD": function( type, what, argument, first, last ) {
			var simple = type.slice( 0, 3 ) !== "nth",
				forward = type.slice( -4 ) !== "last",
				ofType = what === "of-type";

			return first === 1 && last === 0 ?

				// Shortcut for :nth-*(n)
				function( elem ) {
					return !!elem.parentNode;
				} :

				function( elem, context, xml ) {
					var cache, uniqueCache, outerCache, node, nodeIndex, start,
						dir = simple !== forward ? "nextSibling" : "previousSibling",
						parent = elem.parentNode,
						name = ofType && elem.nodeName.toLowerCase(),
						useCache = !xml && !ofType,
						diff = false;

					if ( parent ) {

						// :(first|last|only)-(child|of-type)
						if ( simple ) {
							while ( dir ) {
								node = elem;
								while ( (node = node[ dir ]) ) {
									if ( ofType ?
										node.nodeName.toLowerCase() === name :
										node.nodeType === 1 ) {

										return false;
									}
								}
								// Reverse direction for :only-* (if we haven't yet done so)
								start = dir = type === "only" && !start && "nextSibling";
							}
							return true;
						}

						start = [ forward ? parent.firstChild : parent.lastChild ];

						// non-xml :nth-child(...) stores cache data on `parent`
						if ( forward && useCache ) {

							// Seek `elem` from a previously-cached index

							// ...in a gzip-friendly way
							node = parent;
							outerCache = node[ expando ] || (node[ expando ] = {});

							// Support: IE <9 only
							// Defend against cloned attroperties (jQuery gh-1709)
							uniqueCache = outerCache[ node.uniqueID ] ||
								(outerCache[ node.uniqueID ] = {});

							cache = uniqueCache[ type ] || [];
							nodeIndex = cache[ 0 ] === dirruns && cache[ 1 ];
							diff = nodeIndex && cache[ 2 ];
							node = nodeIndex && parent.childNodes[ nodeIndex ];

							while ( (node = ++nodeIndex && node && node[ dir ] ||

								// Fallback to seeking `elem` from the start
								(diff = nodeIndex = 0) || start.pop()) ) {

								// When found, cache indexes on `parent` and break
								if ( node.nodeType === 1 && ++diff && node === elem ) {
									uniqueCache[ type ] = [ dirruns, nodeIndex, diff ];
									break;
								}
							}

						} else {
							// Use previously-cached element index if available
							if ( useCache ) {
								// ...in a gzip-friendly way
								node = elem;
								outerCache = node[ expando ] || (node[ expando ] = {});

								// Support: IE <9 only
								// Defend against cloned attroperties (jQuery gh-1709)
								uniqueCache = outerCache[ node.uniqueID ] ||
									(outerCache[ node.uniqueID ] = {});

								cache = uniqueCache[ type ] || [];
								nodeIndex = cache[ 0 ] === dirruns && cache[ 1 ];
								diff = nodeIndex;
							}

							// xml :nth-child(...)
							// or :nth-last-child(...) or :nth(-last)?-of-type(...)
							if ( diff === false ) {
								// Use the same loop as above to seek `elem` from the start
								while ( (node = ++nodeIndex && node && node[ dir ] ||
									(diff = nodeIndex = 0) || start.pop()) ) {

									if ( ( ofType ?
										node.nodeName.toLowerCase() === name :
										node.nodeType === 1 ) &&
										++diff ) {

										// Cache the index of each encountered element
										if ( useCache ) {
											outerCache = node[ expando ] || (node[ expando ] = {});

											// Support: IE <9 only
											// Defend against cloned attroperties (jQuery gh-1709)
											uniqueCache = outerCache[ node.uniqueID ] ||
												(outerCache[ node.uniqueID ] = {});

											uniqueCache[ type ] = [ dirruns, diff ];
										}

										if ( node === elem ) {
											break;
										}
									}
								}
							}
						}

						// Incorporate the offset, then check against cycle size
						diff -= last;
						return diff === first || ( diff % first === 0 && diff / first >= 0 );
					}
				};
		},

		"PSEUDO": function( pseudo, argument ) {
			// pseudo-class names are case-insensitive
			// http://www.w3.org/TR/selectors/#pseudo-classes
			// Prioritize by case sensitivity in case custom pseudos are added with uppercase letters
			// Remember that setFilters inherits from pseudos
			var args,
				fn = Expr.pseudos[ pseudo ] || Expr.setFilters[ pseudo.toLowerCase() ] ||
					Sizzle.error( "unsupported pseudo: " + pseudo );

			// The user may use createPseudo to indicate that
			// arguments are needed to create the filter function
			// just as Sizzle does
			if ( fn[ expando ] ) {
				return fn( argument );
			}

			// But maintain support for old signatures
			if ( fn.length > 1 ) {
				args = [ pseudo, pseudo, "", argument ];
				return Expr.setFilters.hasOwnProperty( pseudo.toLowerCase() ) ?
					markFunction(function( seed, matches ) {
						var idx,
							matched = fn( seed, argument ),
							i = matched.length;
						while ( i-- ) {
							idx = indexOf( seed, matched[i] );
							seed[ idx ] = !( matches[ idx ] = matched[i] );
						}
					}) :
					function( elem ) {
						return fn( elem, 0, args );
					};
			}

			return fn;
		}
	},

	pseudos: {
		// Potentially complex pseudos
		"not": markFunction(function( selector ) {
			// Trim the selector passed to compile
			// to avoid treating leading and trailing
			// spaces as combinators
			var input = [],
				results = [],
				matcher = compile( selector.replace( rtrim, "$1" ) );

			return matcher[ expando ] ?
				markFunction(function( seed, matches, context, xml ) {
					var elem,
						unmatched = matcher( seed, null, xml, [] ),
						i = seed.length;

					// Match elements unmatched by `matcher`
					while ( i-- ) {
						if ( (elem = unmatched[i]) ) {
							seed[i] = !(matches[i] = elem);
						}
					}
				}) :
				function( elem, context, xml ) {
					input[0] = elem;
					matcher( input, null, xml, results );
					// Don't keep the element (issue #299)
					input[0] = null;
					return !results.pop();
				};
		}),

		"has": markFunction(function( selector ) {
			return function( elem ) {
				return Sizzle( selector, elem ).length > 0;
			};
		}),

		"contains": markFunction(function( text ) {
			text = text.replace( runescape, funescape );
			return function( elem ) {
				return ( elem.textContent || elem.innerText || getText( elem ) ).indexOf( text ) > -1;
			};
		}),

		// "Whether an element is represented by a :lang() selector
		// is based solely on the element's language value
		// being equal to the identifier C,
		// or beginning with the identifier C immediately followed by "-".
		// The matching of C against the element's language value is performed case-insensitively.
		// The identifier C does not have to be a valid language name."
		// http://www.w3.org/TR/selectors/#lang-pseudo
		"lang": markFunction( function( lang ) {
			// lang value must be a valid identifier
			if ( !ridentifier.test(lang || "") ) {
				Sizzle.error( "unsupported lang: " + lang );
			}
			lang = lang.replace( runescape, funescape ).toLowerCase();
			return function( elem ) {
				var elemLang;
				do {
					if ( (elemLang = documentIsHTML ?
						elem.lang :
						elem.getAttribute("xml:lang") || elem.getAttribute("lang")) ) {

						elemLang = elemLang.toLowerCase();
						return elemLang === lang || elemLang.indexOf( lang + "-" ) === 0;
					}
				} while ( (elem = elem.parentNode) && elem.nodeType === 1 );
				return false;
			};
		}),

		// Miscellaneous
		"target": function( elem ) {
			var hash = window.location && window.location.hash;
			return hash && hash.slice( 1 ) === elem.id;
		},

		"root": function( elem ) {
			return elem === docElem;
		},

		"focus": function( elem ) {
			return elem === document.activeElement && (!document.hasFocus || document.hasFocus()) && !!(elem.type || elem.href || ~elem.tabIndex);
		},

		// Boolean properties
		"enabled": createDisabledPseudo( false ),
		"disabled": createDisabledPseudo( true ),

		"checked": function( elem ) {
			// In CSS3, :checked should return both checked and selected elements
			// http://www.w3.org/TR/2011/REC-css3-selectors-20110929/#checked
			var nodeName = elem.nodeName.toLowerCase();
			return (nodeName === "input" && !!elem.checked) || (nodeName === "option" && !!elem.selected);
		},

		"selected": function( elem ) {
			// Accessing this property makes selected-by-default
			// options in Safari work properly
			if ( elem.parentNode ) {
				elem.parentNode.selectedIndex;
			}

			return elem.selected === true;
		},

		// Contents
		"empty": function( elem ) {
			// http://www.w3.org/TR/selectors/#empty-pseudo
			// :empty is negated by element (1) or content nodes (text: 3; cdata: 4; entity ref: 5),
			//   but not by others (comment: 8; processing instruction: 7; etc.)
			// nodeType < 6 works because attributes (2) do not appear as children
			for ( elem = elem.firstChild; elem; elem = elem.nextSibling ) {
				if ( elem.nodeType < 6 ) {
					return false;
				}
			}
			return true;
		},

		"parent": function( elem ) {
			return !Expr.pseudos["empty"]( elem );
		},

		// Element/input types
		"header": function( elem ) {
			return rheader.test( elem.nodeName );
		},

		"input": function( elem ) {
			return rinputs.test( elem.nodeName );
		},

		"button": function( elem ) {
			var name = elem.nodeName.toLowerCase();
			return name === "input" && elem.type === "button" || name === "button";
		},

		"text": function( elem ) {
			var attr;
			return elem.nodeName.toLowerCase() === "input" &&
				elem.type === "text" &&

				// Support: IE<8
				// New HTML5 attribute values (e.g., "search") appear with elem.type === "text"
				( (attr = elem.getAttribute("type")) == null || attr.toLowerCase() === "text" );
		},

		// Position-in-collection
		"first": createPositionalPseudo(function() {
			return [ 0 ];
		}),

		"last": createPositionalPseudo(function( matchIndexes, length ) {
			return [ length - 1 ];
		}),

		"eq": createPositionalPseudo(function( matchIndexes, length, argument ) {
			return [ argument < 0 ? argument + length : argument ];
		}),

		"even": createPositionalPseudo(function( matchIndexes, length ) {
			var i = 0;
			for ( ; i < length; i += 2 ) {
				matchIndexes.push( i );
			}
			return matchIndexes;
		}),

		"odd": createPositionalPseudo(function( matchIndexes, length ) {
			var i = 1;
			for ( ; i < length; i += 2 ) {
				matchIndexes.push( i );
			}
			return matchIndexes;
		}),

		"lt": createPositionalPseudo(function( matchIndexes, length, argument ) {
			var i = argument < 0 ? argument + length : argument;
			for ( ; --i >= 0; ) {
				matchIndexes.push( i );
			}
			return matchIndexes;
		}),

		"gt": createPositionalPseudo(function( matchIndexes, length, argument ) {
			var i = argument < 0 ? argument + length : argument;
			for ( ; ++i < length; ) {
				matchIndexes.push( i );
			}
			return matchIndexes;
		})
	}
};

Expr.pseudos["nth"] = Expr.pseudos["eq"];

// Add button/input type pseudos
for ( i in { radio: true, checkbox: true, file: true, password: true, image: true } ) {
	Expr.pseudos[ i ] = createInputPseudo( i );
}
for ( i in { submit: true, reset: true } ) {
	Expr.pseudos[ i ] = createButtonPseudo( i );
}

// Easy API for creating new setFilters
function setFilters() {}
setFilters.prototype = Expr.filters = Expr.pseudos;
Expr.setFilters = new setFilters();

tokenize = Sizzle.tokenize = function( selector, parseOnly ) {
	var matched, match, tokens, type,
		soFar, groups, preFilters,
		cached = tokenCache[ selector + " " ];

	if ( cached ) {
		return parseOnly ? 0 : cached.slice( 0 );
	}

	soFar = selector;
	groups = [];
	preFilters = Expr.preFilter;

	while ( soFar ) {

		// Comma and first run
		if ( !matched || (match = rcomma.exec( soFar )) ) {
			if ( match ) {
				// Don't consume trailing commas as valid
				soFar = soFar.slice( match[0].length ) || soFar;
			}
			groups.push( (tokens = []) );
		}

		matched = false;

		// Combinators
		if ( (match = rcombinators.exec( soFar )) ) {
			matched = match.shift();
			tokens.push({
				value: matched,
				// Cast descendant combinators to space
				type: match[0].replace( rtrim, " " )
			});
			soFar = soFar.slice( matched.length );
		}

		// Filters
		for ( type in Expr.filter ) {
			if ( (match = matchExpr[ type ].exec( soFar )) && (!preFilters[ type ] ||
				(match = preFilters[ type ]( match ))) ) {
				matched = match.shift();
				tokens.push({
					value: matched,
					type: type,
					matches: match
				});
				soFar = soFar.slice( matched.length );
			}
		}

		if ( !matched ) {
			break;
		}
	}

	// Return the length of the invalid excess
	// if we're just parsing
	// Otherwise, throw an error or return tokens
	return parseOnly ?
		soFar.length :
		soFar ?
			Sizzle.error( selector ) :
			// Cache the tokens
			tokenCache( selector, groups ).slice( 0 );
};

function toSelector( tokens ) {
	var i = 0,
		len = tokens.length,
		selector = "";
	for ( ; i < len; i++ ) {
		selector += tokens[i].value;
	}
	return selector;
}

function addCombinator( matcher, combinator, base ) {
	var dir = combinator.dir,
		skip = combinator.next,
		key = skip || dir,
		checkNonElements = base && key === "parentNode",
		doneName = done++;

	return combinator.first ?
		// Check against closest ancestor/preceding element
		function( elem, context, xml ) {
			while ( (elem = elem[ dir ]) ) {
				if ( elem.nodeType === 1 || checkNonElements ) {
					return matcher( elem, context, xml );
				}
			}
			return false;
		} :

		// Check against all ancestor/preceding elements
		function( elem, context, xml ) {
			var oldCache, uniqueCache, outerCache,
				newCache = [ dirruns, doneName ];

			// We can't set arbitrary data on XML nodes, so they don't benefit from combinator caching
			if ( xml ) {
				while ( (elem = elem[ dir ]) ) {
					if ( elem.nodeType === 1 || checkNonElements ) {
						if ( matcher( elem, context, xml ) ) {
							return true;
						}
					}
				}
			} else {
				while ( (elem = elem[ dir ]) ) {
					if ( elem.nodeType === 1 || checkNonElements ) {
						outerCache = elem[ expando ] || (elem[ expando ] = {});

						// Support: IE <9 only
						// Defend against cloned attroperties (jQuery gh-1709)
						uniqueCache = outerCache[ elem.uniqueID ] || (outerCache[ elem.uniqueID ] = {});

						if ( skip && skip === elem.nodeName.toLowerCase() ) {
							elem = elem[ dir ] || elem;
						} else if ( (oldCache = uniqueCache[ key ]) &&
							oldCache[ 0 ] === dirruns && oldCache[ 1 ] === doneName ) {

							// Assign to newCache so results back-propagate to previous elements
							return (newCache[ 2 ] = oldCache[ 2 ]);
						} else {
							// Reuse newcache so results back-propagate to previous elements
							uniqueCache[ key ] = newCache;

							// A match means we're done; a fail means we have to keep checking
							if ( (newCache[ 2 ] = matcher( elem, context, xml )) ) {
								return true;
							}
						}
					}
				}
			}
			return false;
		};
}

function elementMatcher( matchers ) {
	return matchers.length > 1 ?
		function( elem, context, xml ) {
			var i = matchers.length;
			while ( i-- ) {
				if ( !matchers[i]( elem, context, xml ) ) {
					return false;
				}
			}
			return true;
		} :
		matchers[0];
}

function multipleContexts( selector, contexts, results ) {
	var i = 0,
		len = contexts.length;
	for ( ; i < len; i++ ) {
		Sizzle( selector, contexts[i], results );
	}
	return results;
}

function condense( unmatched, map, filter, context, xml ) {
	var elem,
		newUnmatched = [],
		i = 0,
		len = unmatched.length,
		mapped = map != null;

	for ( ; i < len; i++ ) {
		if ( (elem = unmatched[i]) ) {
			if ( !filter || filter( elem, context, xml ) ) {
				newUnmatched.push( elem );
				if ( mapped ) {
					map.push( i );
				}
			}
		}
	}

	return newUnmatched;
}

function setMatcher( preFilter, selector, matcher, postFilter, postFinder, postSelector ) {
	if ( postFilter && !postFilter[ expando ] ) {
		postFilter = setMatcher( postFilter );
	}
	if ( postFinder && !postFinder[ expando ] ) {
		postFinder = setMatcher( postFinder, postSelector );
	}
	return markFunction(function( seed, results, context, xml ) {
		var temp, i, elem,
			preMap = [],
			postMap = [],
			preexisting = results.length,

			// Get initial elements from seed or context
			elems = seed || multipleContexts( selector || "*", context.nodeType ? [ context ] : context, [] ),

			// Prefilter to get matcher input, preserving a map for seed-results synchronization
			matcherIn = preFilter && ( seed || !selector ) ?
				condense( elems, preMap, preFilter, context, xml ) :
				elems,

			matcherOut = matcher ?
				// If we have a postFinder, or filtered seed, or non-seed postFilter or preexisting results,
				postFinder || ( seed ? preFilter : preexisting || postFilter ) ?

					// ...intermediate processing is necessary
					[] :

					// ...otherwise use results directly
					results :
				matcherIn;

		// Find primary matches
		if ( matcher ) {
			matcher( matcherIn, matcherOut, context, xml );
		}

		// Apply postFilter
		if ( postFilter ) {
			temp = condense( matcherOut, postMap );
			postFilter( temp, [], context, xml );

			// Un-match failing elements by moving them back to matcherIn
			i = temp.length;
			while ( i-- ) {
				if ( (elem = temp[i]) ) {
					matcherOut[ postMap[i] ] = !(matcherIn[ postMap[i] ] = elem);
				}
			}
		}

		if ( seed ) {
			if ( postFinder || preFilter ) {
				if ( postFinder ) {
					// Get the final matcherOut by condensing this intermediate into postFinder contexts
					temp = [];
					i = matcherOut.length;
					while ( i-- ) {
						if ( (elem = matcherOut[i]) ) {
							// Restore matcherIn since elem is not yet a final match
							temp.push( (matcherIn[i] = elem) );
						}
					}
					postFinder( null, (matcherOut = []), temp, xml );
				}

				// Move matched elements from seed to results to keep them synchronized
				i = matcherOut.length;
				while ( i-- ) {
					if ( (elem = matcherOut[i]) &&
						(temp = postFinder ? indexOf( seed, elem ) : preMap[i]) > -1 ) {

						seed[temp] = !(results[temp] = elem);
					}
				}
			}

		// Add elements to results, through postFinder if defined
		} else {
			matcherOut = condense(
				matcherOut === results ?
					matcherOut.splice( preexisting, matcherOut.length ) :
					matcherOut
			);
			if ( postFinder ) {
				postFinder( null, results, matcherOut, xml );
			} else {
				push.apply( results, matcherOut );
			}
		}
	});
}

function matcherFromTokens( tokens ) {
	var checkContext, matcher, j,
		len = tokens.length,
		leadingRelative = Expr.relative[ tokens[0].type ],
		implicitRelative = leadingRelative || Expr.relative[" "],
		i = leadingRelative ? 1 : 0,

		// The foundational matcher ensures that elements are reachable from top-level context(s)
		matchContext = addCombinator( function( elem ) {
			return elem === checkContext;
		}, implicitRelative, true ),
		matchAnyContext = addCombinator( function( elem ) {
			return indexOf( checkContext, elem ) > -1;
		}, implicitRelative, true ),
		matchers = [ function( elem, context, xml ) {
			var ret = ( !leadingRelative && ( xml || context !== outermostContext ) ) || (
				(checkContext = context).nodeType ?
					matchContext( elem, context, xml ) :
					matchAnyContext( elem, context, xml ) );
			// Avoid hanging onto element (issue #299)
			checkContext = null;
			return ret;
		} ];

	for ( ; i < len; i++ ) {
		if ( (matcher = Expr.relative[ tokens[i].type ]) ) {
			matchers = [ addCombinator(elementMatcher( matchers ), matcher) ];
		} else {
			matcher = Expr.filter[ tokens[i].type ].apply( null, tokens[i].matches );

			// Return special upon seeing a positional matcher
			if ( matcher[ expando ] ) {
				// Find the next relative operator (if any) for proper handling
				j = ++i;
				for ( ; j < len; j++ ) {
					if ( Expr.relative[ tokens[j].type ] ) {
						break;
					}
				}
				return setMatcher(
					i > 1 && elementMatcher( matchers ),
					i > 1 && toSelector(
						// If the preceding token was a descendant combinator, insert an implicit any-element `*`
						tokens.slice( 0, i - 1 ).concat({ value: tokens[ i - 2 ].type === " " ? "*" : "" })
					).replace( rtrim, "$1" ),
					matcher,
					i < j && matcherFromTokens( tokens.slice( i, j ) ),
					j < len && matcherFromTokens( (tokens = tokens.slice( j )) ),
					j < len && toSelector( tokens )
				);
			}
			matchers.push( matcher );
		}
	}

	return elementMatcher( matchers );
}

function matcherFromGroupMatchers( elementMatchers, setMatchers ) {
	var bySet = setMatchers.length > 0,
		byElement = elementMatchers.length > 0,
		superMatcher = function( seed, context, xml, results, outermost ) {
			var elem, j, matcher,
				matchedCount = 0,
				i = "0",
				unmatched = seed && [],
				setMatched = [],
				contextBackup = outermostContext,
				// We must always have either seed elements or outermost context
				elems = seed || byElement && Expr.find["TAG"]( "*", outermost ),
				// Use integer dirruns iff this is the outermost matcher
				dirrunsUnique = (dirruns += contextBackup == null ? 1 : Math.random() || 0.1),
				len = elems.length;

			if ( outermost ) {
				outermostContext = context === document || context || outermost;
			}

			// Add elements passing elementMatchers directly to results
			// Support: IE<9, Safari
			// Tolerate NodeList properties (IE: "length"; Safari: <number>) matching elements by id
			for ( ; i !== len && (elem = elems[i]) != null; i++ ) {
				if ( byElement && elem ) {
					j = 0;
					if ( !context && elem.ownerDocument !== document ) {
						setDocument( elem );
						xml = !documentIsHTML;
					}
					while ( (matcher = elementMatchers[j++]) ) {
						if ( matcher( elem, context || document, xml) ) {
							results.push( elem );
							break;
						}
					}
					if ( outermost ) {
						dirruns = dirrunsUnique;
					}
				}

				// Track unmatched elements for set filters
				if ( bySet ) {
					// They will have gone through all possible matchers
					if ( (elem = !matcher && elem) ) {
						matchedCount--;
					}

					// Lengthen the array for every element, matched or not
					if ( seed ) {
						unmatched.push( elem );
					}
				}
			}

			// `i` is now the count of elements visited above, and adding it to `matchedCount`
			// makes the latter nonnegative.
			matchedCount += i;

			// Apply set filters to unmatched elements
			// NOTE: This can be skipped if there are no unmatched elements (i.e., `matchedCount`
			// equals `i`), unless we didn't visit _any_ elements in the above loop because we have
			// no element matchers and no seed.
			// Incrementing an initially-string "0" `i` allows `i` to remain a string only in that
			// case, which will result in a "00" `matchedCount` that differs from `i` but is also
			// numerically zero.
			if ( bySet && i !== matchedCount ) {
				j = 0;
				while ( (matcher = setMatchers[j++]) ) {
					matcher( unmatched, setMatched, context, xml );
				}

				if ( seed ) {
					// Reintegrate element matches to eliminate the need for sorting
					if ( matchedCount > 0 ) {
						while ( i-- ) {
							if ( !(unmatched[i] || setMatched[i]) ) {
								setMatched[i] = pop.call( results );
							}
						}
					}

					// Discard index placeholder values to get only actual matches
					setMatched = condense( setMatched );
				}

				// Add matches to results
				push.apply( results, setMatched );

				// Seedless set matches succeeding multiple successful matchers stipulate sorting
				if ( outermost && !seed && setMatched.length > 0 &&
					( matchedCount + setMatchers.length ) > 1 ) {

					Sizzle.uniqueSort( results );
				}
			}

			// Override manipulation of globals by nested matchers
			if ( outermost ) {
				dirruns = dirrunsUnique;
				outermostContext = contextBackup;
			}

			return unmatched;
		};

	return bySet ?
		markFunction( superMatcher ) :
		superMatcher;
}

compile = Sizzle.compile = function( selector, match /* Internal Use Only */ ) {
	var i,
		setMatchers = [],
		elementMatchers = [],
		cached = compilerCache[ selector + " " ];

	if ( !cached ) {
		// Generate a function of recursive functions that can be used to check each element
		if ( !match ) {
			match = tokenize( selector );
		}
		i = match.length;
		while ( i-- ) {
			cached = matcherFromTokens( match[i] );
			if ( cached[ expando ] ) {
				setMatchers.push( cached );
			} else {
				elementMatchers.push( cached );
			}
		}

		// Cache the compiled function
		cached = compilerCache( selector, matcherFromGroupMatchers( elementMatchers, setMatchers ) );

		// Save selector and tokenization
		cached.selector = selector;
	}
	return cached;
};

/**
 * A low-level selection function that works with Sizzle's compiled
 *  selector functions
 * @param {String|Function} selector A selector or a pre-compiled
 *  selector function built with Sizzle.compile
 * @param {Element} context
 * @param {Array} [results]
 * @param {Array} [seed] A set of elements to match against
 */
select = Sizzle.select = function( selector, context, results, seed ) {
	var i, tokens, token, type, find,
		compiled = typeof selector === "function" && selector,
		match = !seed && tokenize( (selector = compiled.selector || selector) );

	results = results || [];

	// Try to minimize operations if there is only one selector in the list and no seed
	// (the latter of which guarantees us context)
	if ( match.length === 1 ) {

		// Reduce context if the leading compound selector is an ID
		tokens = match[0] = match[0].slice( 0 );
		if ( tokens.length > 2 && (token = tokens[0]).type === "ID" &&
				context.nodeType === 9 && documentIsHTML && Expr.relative[ tokens[1].type ] ) {

			context = ( Expr.find["ID"]( token.matches[0].replace(runescape, funescape), context ) || [] )[0];
			if ( !context ) {
				return results;

			// Precompiled matchers will still verify ancestry, so step up a level
			} else if ( compiled ) {
				context = context.parentNode;
			}

			selector = selector.slice( tokens.shift().value.length );
		}

		// Fetch a seed set for right-to-left matching
		i = matchExpr["needsContext"].test( selector ) ? 0 : tokens.length;
		while ( i-- ) {
			token = tokens[i];

			// Abort if we hit a combinator
			if ( Expr.relative[ (type = token.type) ] ) {
				break;
			}
			if ( (find = Expr.find[ type ]) ) {
				// Search, expanding context for leading sibling combinators
				if ( (seed = find(
					token.matches[0].replace( runescape, funescape ),
					rsibling.test( tokens[0].type ) && testContext( context.parentNode ) || context
				)) ) {

					// If seed is empty or no tokens remain, we can return early
					tokens.splice( i, 1 );
					selector = seed.length && toSelector( tokens );
					if ( !selector ) {
						push.apply( results, seed );
						return results;
					}

					break;
				}
			}
		}
	}

	// Compile and execute a filtering function if one is not provided
	// Provide `match` to avoid retokenization if we modified the selector above
	( compiled || compile( selector, match ) )(
		seed,
		context,
		!documentIsHTML,
		results,
		!context || rsibling.test( selector ) && testContext( context.parentNode ) || context
	);
	return results;
};

// One-time assignments

// Sort stability
support.sortStable = expando.split("").sort( sortOrder ).join("") === expando;

// Support: Chrome 14-35+
// Always assume duplicates if they aren't passed to the comparison function
support.detectDuplicates = !!hasDuplicate;

// Initialize against the default document
setDocument();

// Support: Webkit<537.32 - Safari 6.0.3/Chrome 25 (fixed in Chrome 27)
// Detached nodes confoundingly follow *each other*
support.sortDetached = assert(function( el ) {
	// Should return 1, but returns 4 (following)
	return el.compareDocumentPosition( document.createElement("fieldset") ) & 1;
});

// Support: IE<8
// Prevent attribute/property "interpolation"
// https://msdn.microsoft.com/en-us/library/ms536429%28VS.85%29.aspx
if ( !assert(function( el ) {
	el.innerHTML = "<a href='#'></a>";
	return el.firstChild.getAttribute("href") === "#" ;
}) ) {
	addHandle( "type|href|height|width", function( elem, name, isXML ) {
		if ( !isXML ) {
			return elem.getAttribute( name, name.toLowerCase() === "type" ? 1 : 2 );
		}
	});
}

// Support: IE<9
// Use defaultValue in place of getAttribute("value")
if ( !support.attributes || !assert(function( el ) {
	el.innerHTML = "<input/>";
	el.firstChild.setAttribute( "value", "" );
	return el.firstChild.getAttribute( "value" ) === "";
}) ) {
	addHandle( "value", function( elem, name, isXML ) {
		if ( !isXML && elem.nodeName.toLowerCase() === "input" ) {
			return elem.defaultValue;
		}
	});
}

// Support: IE<9
// Use getAttributeNode to fetch booleans when getAttribute lies
if ( !assert(function( el ) {
	return el.getAttribute("disabled") == null;
}) ) {
	addHandle( booleans, function( elem, name, isXML ) {
		var val;
		if ( !isXML ) {
			return elem[ name ] === true ? name.toLowerCase() :
					(val = elem.getAttributeNode( name )) && val.specified ?
					val.value :
				null;
		}
	});
}

return Sizzle;

})( window );



jQuery.find = Sizzle;
jQuery.expr = Sizzle.selectors;

// Deprecated
jQuery.expr[ ":" ] = jQuery.expr.pseudos;
jQuery.uniqueSort = jQuery.unique = Sizzle.uniqueSort;
jQuery.text = Sizzle.getText;
jQuery.isXMLDoc = Sizzle.isXML;
jQuery.contains = Sizzle.contains;
jQuery.escapeSelector = Sizzle.escape;




var dir = function( elem, dir, until ) {
	var matched = [],
		truncate = until !== undefined;

	while ( ( elem = elem[ dir ] ) && elem.nodeType !== 9 ) {
		if ( elem.nodeType === 1 ) {
			if ( truncate && jQuery( elem ).is( until ) ) {
				break;
			}
			matched.push( elem );
		}
	}
	return matched;
};


var siblings = function( n, elem ) {
	var matched = [];

	for ( ; n; n = n.nextSibling ) {
		if ( n.nodeType === 1 && n !== elem ) {
			matched.push( n );
		}
	}

	return matched;
};


var rneedsContext = jQuery.expr.match.needsContext;

var rsingleTag = ( /^<([a-z][^\/\0>:\x20\t\r\n\f]*)[\x20\t\r\n\f]*\/?>(?:<\/\1>|)$/i );



var risSimple = /^.[^:#\[\.,]*$/;

// Implement the identical functionality for filter and not
function winnow( elements, qualifier, not ) {
	if ( jQuery.isFunction( qualifier ) ) {
		return jQuery.grep( elements, function( elem, i ) {
			return !!qualifier.call( elem, i, elem ) !== not;
		} );
	}

	// Single element
	if ( qualifier.nodeType ) {
		return jQuery.grep( elements, function( elem ) {
			return ( elem === qualifier ) !== not;
		} );
	}

	// Arraylike of elements (jQuery, arguments, Array)
	if ( typeof qualifier !== "string" ) {
		return jQuery.grep( elements, function( elem ) {
			return ( indexOf.call( qualifier, elem ) > -1 ) !== not;
		} );
	}

	// Simple selector that can be filtered directly, removing non-Elements
	if ( risSimple.test( qualifier ) ) {
		return jQuery.filter( qualifier, elements, not );
	}

	// Complex selector, compare the two sets, removing non-Elements
	qualifier = jQuery.filter( qualifier, elements );
	return jQuery.grep( elements, function( elem ) {
		return ( indexOf.call( qualifier, elem ) > -1 ) !== not && elem.nodeType === 1;
	} );
}

jQuery.filter = function( expr, elems, not ) {
	var elem = elems[ 0 ];

	if ( not ) {
		expr = ":not(" + expr + ")";
	}

	if ( elems.length === 1 && elem.nodeType === 1 ) {
		return jQuery.find.matchesSelector( elem, expr ) ? [ elem ] : [];
	}

	return jQuery.find.matches( expr, jQuery.grep( elems, function( elem ) {
		return elem.nodeType === 1;
	} ) );
};

jQuery.fn.extend( {
	find: function( selector ) {
		var i, ret,
			len = this.length,
			self = this;

		if ( typeof selector !== "string" ) {
			return this.pushStack( jQuery( selector ).filter( function() {
				for ( i = 0; i < len; i++ ) {
					if ( jQuery.contains( self[ i ], this ) ) {
						return true;
					}
				}
			} ) );
		}

		ret = this.pushStack( [] );

		for ( i = 0; i < len; i++ ) {
			jQuery.find( selector, self[ i ], ret );
		}

		return len > 1 ? jQuery.uniqueSort( ret ) : ret;
	},
	filter: function( selector ) {
		return this.pushStack( winnow( this, selector || [], false ) );
	},
	not: function( selector ) {
		return this.pushStack( winnow( this, selector || [], true ) );
	},
	is: function( selector ) {
		return !!winnow(
			this,

			// If this is a positional/relative selector, check membership in the returned set
			// so $("p:first").is("p:last") won't return true for a doc with two "p".
			typeof selector === "string" && rneedsContext.test( selector ) ?
				jQuery( selector ) :
				selector || [],
			false
		).length;
	}
} );


// Initialize a jQuery object


// A central reference to the root jQuery(document)
var rootjQuery,

	// A simple way to check for HTML strings
	// Prioritize #id over <tag> to avoid XSS via location.hash (#9521)
	// Strict HTML recognition (#11290: must start with <)
	// Shortcut simple #id case for speed
	rquickExpr = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]+))$/,

	init = jQuery.fn.init = function( selector, context, root ) {
		var match, elem;

		// HANDLE: $(""), $(null), $(undefined), $(false)
		if ( !selector ) {
			return this;
		}

		// Method init() accepts an alternate rootjQuery
		// so migrate can support jQuery.sub (gh-2101)
		root = root || rootjQuery;

		// Handle HTML strings
		if ( typeof selector === "string" ) {
			if ( selector[ 0 ] === "<" &&
				selector[ selector.length - 1 ] === ">" &&
				selector.length >= 3 ) {

				// Assume that strings that start and end with <> are HTML and skip the regex check
				match = [ null, selector, null ];

			} else {
				match = rquickExpr.exec( selector );
			}

			// Match html or make sure no context is specified for #id
			if ( match && ( match[ 1 ] || !context ) ) {

				// HANDLE: $(html) -> $(array)
				if ( match[ 1 ] ) {
					context = context instanceof jQuery ? context[ 0 ] : context;

					// Option to run scripts is true for back-compat
					// Intentionally let the error be thrown if parseHTML is not present
					jQuery.merge( this, jQuery.parseHTML(
						match[ 1 ],
						context && context.nodeType ? context.ownerDocument || context : document,
						true
					) );

					// HANDLE: $(html, props)
					if ( rsingleTag.test( match[ 1 ] ) && jQuery.isPlainObject( context ) ) {
						for ( match in context ) {

							// Properties of context are called as methods if possible
							if ( jQuery.isFunction( this[ match ] ) ) {
								this[ match ]( context[ match ] );

							// ...and otherwise set as attributes
							} else {
								this.attr( match, context[ match ] );
							}
						}
					}

					return this;

				// HANDLE: $(#id)
				} else {
					elem = document.getElementById( match[ 2 ] );

					if ( elem ) {

						// Inject the element directly into the jQuery object
						this[ 0 ] = elem;
						this.length = 1;
					}
					return this;
				}

			// HANDLE: $(expr, $(...))
			} else if ( !context || context.jquery ) {
				return ( context || root ).find( selector );

			// HANDLE: $(expr, context)
			// (which is just equivalent to: $(context).find(expr)
			} else {
				return this.constructor( context ).find( selector );
			}

		// HANDLE: $(DOMElement)
		} else if ( selector.nodeType ) {
			this[ 0 ] = selector;
			this.length = 1;
			return this;

		// HANDLE: $(function)
		// Shortcut for document ready
		} else if ( jQuery.isFunction( selector ) ) {
			return root.ready !== undefined ?
				root.ready( selector ) :

				// Execute immediately if ready is not present
				selector( jQuery );
		}

		return jQuery.makeArray( selector, this );
	};

// Give the init function the jQuery prototype for later instantiation
init.prototype = jQuery.fn;

// Initialize central reference
rootjQuery = jQuery( document );


var rparentsprev = /^(?:parents|prev(?:Until|All))/,

	// Methods guaranteed to produce a unique set when starting from a unique set
	guaranteedUnique = {
		children: true,
		contents: true,
		next: true,
		prev: true
	};

jQuery.fn.extend( {
	has: function( target ) {
		var targets = jQuery( target, this ),
			l = targets.length;

		return this.filter( function() {
			var i = 0;
			for ( ; i < l; i++ ) {
				if ( jQuery.contains( this, targets[ i ] ) ) {
					return true;
				}
			}
		} );
	},

	closest: function( selectors, context ) {
		var cur,
			i = 0,
			l = this.length,
			matched = [],
			targets = typeof selectors !== "string" && jQuery( selectors );

		// Positional selectors never match, since there's no _selection_ context
		if ( !rneedsContext.test( selectors ) ) {
			for ( ; i < l; i++ ) {
				for ( cur = this[ i ]; cur && cur !== context; cur = cur.parentNode ) {

					// Always skip document fragments
					if ( cur.nodeType < 11 && ( targets ?
						targets.index( cur ) > -1 :

						// Don't pass non-elements to Sizzle
						cur.nodeType === 1 &&
							jQuery.find.matchesSelector( cur, selectors ) ) ) {

						matched.push( cur );
						break;
					}
				}
			}
		}

		return this.pushStack( matched.length > 1 ? jQuery.uniqueSort( matched ) : matched );
	},

	// Determine the position of an element within the set
	index: function( elem ) {

		// No argument, return index in parent
		if ( !elem ) {
			return ( this[ 0 ] && this[ 0 ].parentNode ) ? this.first().prevAll().length : -1;
		}

		// Index in selector
		if ( typeof elem === "string" ) {
			return indexOf.call( jQuery( elem ), this[ 0 ] );
		}

		// Locate the position of the desired element
		return indexOf.call( this,

			// If it receives a jQuery object, the first element is used
			elem.jquery ? elem[ 0 ] : elem
		);
	},

	add: function( selector, context ) {
		return this.pushStack(
			jQuery.uniqueSort(
				jQuery.merge( this.get(), jQuery( selector, context ) )
			)
		);
	},

	addBack: function( selector ) {
		return this.add( selector == null ?
			this.prevObject : this.prevObject.filter( selector )
		);
	}
} );

function sibling( cur, dir ) {
	while ( ( cur = cur[ dir ] ) && cur.nodeType !== 1 ) {}
	return cur;
}

jQuery.each( {
	parent: function( elem ) {
		var parent = elem.parentNode;
		return parent && parent.nodeType !== 11 ? parent : null;
	},
	parents: function( elem ) {
		return dir( elem, "parentNode" );
	},
	parentsUntil: function( elem, i, until ) {
		return dir( elem, "parentNode", until );
	},
	next: function( elem ) {
		return sibling( elem, "nextSibling" );
	},
	prev: function( elem ) {
		return sibling( elem, "previousSibling" );
	},
	nextAll: function( elem ) {
		return dir( elem, "nextSibling" );
	},
	prevAll: function( elem ) {
		return dir( elem, "previousSibling" );
	},
	nextUntil: function( elem, i, until ) {
		return dir( elem, "nextSibling", until );
	},
	prevUntil: function( elem, i, until ) {
		return dir( elem, "previousSibling", until );
	},
	siblings: function( elem ) {
		return siblings( ( elem.parentNode || {} ).firstChild, elem );
	},
	children: function( elem ) {
		return siblings( elem.firstChild );
	},
	contents: function( elem ) {
		return elem.contentDocument || jQuery.merge( [], elem.childNodes );
	}
}, function( name, fn ) {
	jQuery.fn[ name ] = function( until, selector ) {
		var matched = jQuery.map( this, fn, until );

		if ( name.slice( -5 ) !== "Until" ) {
			selector = until;
		}

		if ( selector && typeof selector === "string" ) {
			matched = jQuery.filter( selector, matched );
		}

		if ( this.length > 1 ) {

			// Remove duplicates
			if ( !guaranteedUnique[ name ] ) {
				jQuery.uniqueSort( matched );
			}

			// Reverse order for parents* and prev-derivatives
			if ( rparentsprev.test( name ) ) {
				matched.reverse();
			}
		}

		return this.pushStack( matched );
	};
} );
var rnothtmlwhite = ( /[^\x20\t\r\n\f]+/g );



// Convert String-formatted options into Object-formatted ones
function createOptions( options ) {
	var object = {};
	jQuery.each( options.match( rnothtmlwhite ) || [], function( _, flag ) {
		object[ flag ] = true;
	} );
	return object;
}

/*
 * Create a callback list using the following parameters:
 *
 *	options: an optional list of space-separated options that will change how
 *			the callback list behaves or a more traditional option object
 *
 * By default a callback list will act like an event callback list and can be
 * "fired" multiple times.
 *
 * Possible options:
 *
 *	once:			will ensure the callback list can only be fired once (like a Deferred)
 *
 *	memory:			will keep track of previous values and will call any callback added
 *					after the list has been fired right away with the latest "memorized"
 *					values (like a Deferred)
 *
 *	unique:			will ensure a callback can only be added once (no duplicate in the list)
 *
 *	stopOnFalse:	interrupt callings when a callback returns false
 *
 */
jQuery.Callbacks = function( options ) {

	// Convert options from String-formatted to Object-formatted if needed
	// (we check in cache first)
	options = typeof options === "string" ?
		createOptions( options ) :
		jQuery.extend( {}, options );

	var // Flag to know if list is currently firing
		firing,

		// Last fire value for non-forgettable lists
		memory,

		// Flag to know if list was already fired
		fired,

		// Flag to prevent firing
		locked,

		// Actual callback list
		list = [],

		// Queue of execution data for repeatable lists
		queue = [],

		// Index of currently firing callback (modified by add/remove as needed)
		firingIndex = -1,

		// Fire callbacks
		fire = function() {

			// Enforce single-firing
			locked = options.once;

			// Execute callbacks for all pending executions,
			// respecting firingIndex overrides and runtime changes
			fired = firing = true;
			for ( ; queue.length; firingIndex = -1 ) {
				memory = queue.shift();
				while ( ++firingIndex < list.length ) {

					// Run callback and check for early termination
					if ( list[ firingIndex ].apply( memory[ 0 ], memory[ 1 ] ) === false &&
						options.stopOnFalse ) {

						// Jump to end and forget the data so .add doesn't re-fire
						firingIndex = list.length;
						memory = false;
					}
				}
			}

			// Forget the data if we're done with it
			if ( !options.memory ) {
				memory = false;
			}

			firing = false;

			// Clean up if we're done firing for good
			if ( locked ) {

				// Keep an empty list if we have data for future add calls
				if ( memory ) {
					list = [];

				// Otherwise, this object is spent
				} else {
					list = "";
				}
			}
		},

		// Actual Callbacks object
		self = {

			// Add a callback or a collection of callbacks to the list
			add: function() {
				if ( list ) {

					// If we have memory from a past run, we should fire after adding
					if ( memory && !firing ) {
						firingIndex = list.length - 1;
						queue.push( memory );
					}

					( function add( args ) {
						jQuery.each( args, function( _, arg ) {
							if ( jQuery.isFunction( arg ) ) {
								if ( !options.unique || !self.has( arg ) ) {
									list.push( arg );
								}
							} else if ( arg && arg.length && jQuery.type( arg ) !== "string" ) {

								// Inspect recursively
								add( arg );
							}
						} );
					} )( arguments );

					if ( memory && !firing ) {
						fire();
					}
				}
				return this;
			},

			// Remove a callback from the list
			remove: function() {
				jQuery.each( arguments, function( _, arg ) {
					var index;
					while ( ( index = jQuery.inArray( arg, list, index ) ) > -1 ) {
						list.splice( index, 1 );

						// Handle firing indexes
						if ( index <= firingIndex ) {
							firingIndex--;
						}
					}
				} );
				return this;
			},

			// Check if a given callback is in the list.
			// If no argument is given, return whether or not list has callbacks attached.
			has: function( fn ) {
				return fn ?
					jQuery.inArray( fn, list ) > -1 :
					list.length > 0;
			},

			// Remove all callbacks from the list
			empty: function() {
				if ( list ) {
					list = [];
				}
				return this;
			},

			// Disable .fire and .add
			// Abort any current/pending executions
			// Clear all callbacks and values
			disable: function() {
				locked = queue = [];
				list = memory = "";
				return this;
			},
			disabled: function() {
				return !list;
			},

			// Disable .fire
			// Also disable .add unless we have memory (since it would have no effect)
			// Abort any pending executions
			lock: function() {
				locked = queue = [];
				if ( !memory && !firing ) {
					list = memory = "";
				}
				return this;
			},
			locked: function() {
				return !!locked;
			},

			// Call all callbacks with the given context and arguments
			fireWith: function( context, args ) {
				if ( !locked ) {
					args = args || [];
					args = [ context, args.slice ? args.slice() : args ];
					queue.push( args );
					if ( !firing ) {
						fire();
					}
				}
				return this;
			},

			// Call all the callbacks with the given arguments
			fire: function() {
				self.fireWith( this, arguments );
				return this;
			},

			// To know if the callbacks have already been called at least once
			fired: function() {
				return !!fired;
			}
		};

	return self;
};


function Identity( v ) {
	return v;
}
function Thrower( ex ) {
	throw ex;
}

function adoptValue( value, resolve, reject ) {
	var method;

	try {

		// Check for promise aspect first to privilege synchronous behavior
		if ( value && jQuery.isFunction( ( method = value.promise ) ) ) {
			method.call( value ).done( resolve ).fail( reject );

		// Other thenables
		} else if ( value && jQuery.isFunction( ( method = value.then ) ) ) {
			method.call( value, resolve, reject );

		// Other non-thenables
		} else {

			// Support: Android 4.0 only
			// Strict mode functions invoked without .call/.apply get global-object context
			resolve.call( undefined, value );
		}

	// For Promises/A+, convert exceptions into rejections
	// Since jQuery.when doesn't unwrap thenables, we can skip the extra checks appearing in
	// Deferred#then to conditionally suppress rejection.
	} catch ( value ) {

		// Support: Android 4.0 only
		// Strict mode functions invoked without .call/.apply get global-object context
		reject.call( undefined, value );
	}
}

jQuery.extend( {

	Deferred: function( func ) {
		var tuples = [

				// action, add listener, callbacks,
				// ... .then handlers, argument index, [final state]
				[ "notify", "progress", jQuery.Callbacks( "memory" ),
					jQuery.Callbacks( "memory" ), 2 ],
				[ "resolve", "done", jQuery.Callbacks( "once memory" ),
					jQuery.Callbacks( "once memory" ), 0, "resolved" ],
				[ "reject", "fail", jQuery.Callbacks( "once memory" ),
					jQuery.Callbacks( "once memory" ), 1, "rejected" ]
			],
			state = "pending",
			promise = {
				state: function() {
					return state;
				},
				always: function() {
					deferred.done( arguments ).fail( arguments );
					return this;
				},
				"catch": function( fn ) {
					return promise.then( null, fn );
				},

				// Keep pipe for back-compat
				pipe: function( /* fnDone, fnFail, fnProgress */ ) {
					var fns = arguments;

					return jQuery.Deferred( function( newDefer ) {
						jQuery.each( tuples, function( i, tuple ) {

							// Map tuples (progress, done, fail) to arguments (done, fail, progress)
							var fn = jQuery.isFunction( fns[ tuple[ 4 ] ] ) && fns[ tuple[ 4 ] ];

							// deferred.progress(function() { bind to newDefer or newDefer.notify })
							// deferred.done(function() { bind to newDefer or newDefer.resolve })
							// deferred.fail(function() { bind to newDefer or newDefer.reject })
							deferred[ tuple[ 1 ] ]( function() {
								var returned = fn && fn.apply( this, arguments );
								if ( returned && jQuery.isFunction( returned.promise ) ) {
									returned.promise()
										.progress( newDefer.notify )
										.done( newDefer.resolve )
										.fail( newDefer.reject );
								} else {
									newDefer[ tuple[ 0 ] + "With" ](
										this,
										fn ? [ returned ] : arguments
									);
								}
							} );
						} );
						fns = null;
					} ).promise();
				},
				then: function( onFulfilled, onRejected, onProgress ) {
					var maxDepth = 0;
					function resolve( depth, deferred, handler, special ) {
						return function() {
							var that = this,
								args = arguments,
								mightThrow = function() {
									var returned, then;

									// Support: Promises/A+ section 2.3.3.3.3
									// https://promisesaplus.com/#point-59
									// Ignore double-resolution attempts
									if ( depth < maxDepth ) {
										return;
									}

									returned = handler.apply( that, args );

									// Support: Promises/A+ section 2.3.1
									// https://promisesaplus.com/#point-48
									if ( returned === deferred.promise() ) {
										throw new TypeError( "Thenable self-resolution" );
									}

									// Support: Promises/A+ sections 2.3.3.1, 3.5
									// https://promisesaplus.com/#point-54
									// https://promisesaplus.com/#point-75
									// Retrieve `then` only once
									then = returned &&

										// Support: Promises/A+ section 2.3.4
										// https://promisesaplus.com/#point-64
										// Only check objects and functions for thenability
										( typeof returned === "object" ||
											typeof returned === "function" ) &&
										returned.then;

									// Handle a returned thenable
									if ( jQuery.isFunction( then ) ) {

										// Special processors (notify) just wait for resolution
										if ( special ) {
											then.call(
												returned,
												resolve( maxDepth, deferred, Identity, special ),
												resolve( maxDepth, deferred, Thrower, special )
											);

										// Normal processors (resolve) also hook into progress
										} else {

											// ...and disregard older resolution values
											maxDepth++;

											then.call(
												returned,
												resolve( maxDepth, deferred, Identity, special ),
												resolve( maxDepth, deferred, Thrower, special ),
												resolve( maxDepth, deferred, Identity,
													deferred.notifyWith )
											);
										}

									// Handle all other returned values
									} else {

										// Only substitute handlers pass on context
										// and multiple values (non-spec behavior)
										if ( handler !== Identity ) {
											that = undefined;
											args = [ returned ];
										}

										// Process the value(s)
										// Default process is resolve
										( special || deferred.resolveWith )( that, args );
									}
								},

								// Only normal processors (resolve) catch and reject exceptions
								process = special ?
									mightThrow :
									function() {
										try {
											mightThrow();
										} catch ( e ) {

											if ( jQuery.Deferred.exceptionHook ) {
												jQuery.Deferred.exceptionHook( e,
													process.stackTrace );
											}

											// Support: Promises/A+ section 2.3.3.3.4.1
											// https://promisesaplus.com/#point-61
											// Ignore post-resolution exceptions
											if ( depth + 1 >= maxDepth ) {

												// Only substitute handlers pass on context
												// and multiple values (non-spec behavior)
												if ( handler !== Thrower ) {
													that = undefined;
													args = [ e ];
												}

												deferred.rejectWith( that, args );
											}
										}
									};

							// Support: Promises/A+ section 2.3.3.3.1
							// https://promisesaplus.com/#point-57
							// Re-resolve promises immediately to dodge false rejection from
							// subsequent errors
							if ( depth ) {
								process();
							} else {

								// Call an optional hook to record the stack, in case of exception
								// since it's otherwise lost when execution goes async
								if ( jQuery.Deferred.getStackHook ) {
									process.stackTrace = jQuery.Deferred.getStackHook();
								}
								window.setTimeout( process );
							}
						};
					}

					return jQuery.Deferred( function( newDefer ) {

						// progress_handlers.add( ... )
						tuples[ 0 ][ 3 ].add(
							resolve(
								0,
								newDefer,
								jQuery.isFunction( onProgress ) ?
									onProgress :
									Identity,
								newDefer.notifyWith
							)
						);

						// fulfilled_handlers.add( ... )
						tuples[ 1 ][ 3 ].add(
							resolve(
								0,
								newDefer,
								jQuery.isFunction( onFulfilled ) ?
									onFulfilled :
									Identity
							)
						);

						// rejected_handlers.add( ... )
						tuples[ 2 ][ 3 ].add(
							resolve(
								0,
								newDefer,
								jQuery.isFunction( onRejected ) ?
									onRejected :
									Thrower
							)
						);
					} ).promise();
				},

				// Get a promise for this deferred
				// If obj is provided, the promise aspect is added to the object
				promise: function( obj ) {
					return obj != null ? jQuery.extend( obj, promise ) : promise;
				}
			},
			deferred = {};

		// Add list-specific methods
		jQuery.each( tuples, function( i, tuple ) {
			var list = tuple[ 2 ],
				stateString = tuple[ 5 ];

			// promise.progress = list.add
			// promise.done = list.add
			// promise.fail = list.add
			promise[ tuple[ 1 ] ] = list.add;

			// Handle state
			if ( stateString ) {
				list.add(
					function() {

						// state = "resolved" (i.e., fulfilled)
						// state = "rejected"
						state = stateString;
					},

					// rejected_callbacks.disable
					// fulfilled_callbacks.disable
					tuples[ 3 - i ][ 2 ].disable,

					// progress_callbacks.lock
					tuples[ 0 ][ 2 ].lock
				);
			}

			// progress_handlers.fire
			// fulfilled_handlers.fire
			// rejected_handlers.fire
			list.add( tuple[ 3 ].fire );

			// deferred.notify = function() { deferred.notifyWith(...) }
			// deferred.resolve = function() { deferred.resolveWith(...) }
			// deferred.reject = function() { deferred.rejectWith(...) }
			deferred[ tuple[ 0 ] ] = function() {
				deferred[ tuple[ 0 ] + "With" ]( this === deferred ? undefined : this, arguments );
				return this;
			};

			// deferred.notifyWith = list.fireWith
			// deferred.resolveWith = list.fireWith
			// deferred.rejectWith = list.fireWith
			deferred[ tuple[ 0 ] + "With" ] = list.fireWith;
		} );

		// Make the deferred a promise
		promise.promise( deferred );

		// Call given func if any
		if ( func ) {
			func.call( deferred, deferred );
		}

		// All done!
		return deferred;
	},

	// Deferred helper
	when: function( singleValue ) {
		var

			// count of uncompleted subordinates
			remaining = arguments.length,

			// count of unprocessed arguments
			i = remaining,

			// subordinate fulfillment data
			resolveContexts = Array( i ),
			resolveValues = slice.call( arguments ),

			// the master Deferred
			master = jQuery.Deferred(),

			// subordinate callback factory
			updateFunc = function( i ) {
				return function( value ) {
					resolveContexts[ i ] = this;
					resolveValues[ i ] = arguments.length > 1 ? slice.call( arguments ) : value;
					if ( !( --remaining ) ) {
						master.resolveWith( resolveContexts, resolveValues );
					}
				};
			};

		// Single- and empty arguments are adopted like Promise.resolve
		if ( remaining <= 1 ) {
			adoptValue( singleValue, master.done( updateFunc( i ) ).resolve, master.reject );

			// Use .then() to unwrap secondary thenables (cf. gh-3000)
			if ( master.state() === "pending" ||
				jQuery.isFunction( resolveValues[ i ] && resolveValues[ i ].then ) ) {

				return master.then();
			}
		}

		// Multiple arguments are aggregated like Promise.all array elements
		while ( i-- ) {
			adoptValue( resolveValues[ i ], updateFunc( i ), master.reject );
		}

		return master.promise();
	}
} );


// These usually indicate a programmer mistake during development,
// warn about them ASAP rather than swallowing them by default.
var rerrorNames = /^(Eval|Internal|Range|Reference|Syntax|Type|URI)Error$/;

jQuery.Deferred.exceptionHook = function( error, stack ) {

	// Support: IE 8 - 9 only
	// Console exists when dev tools are open, which can happen at any time
	if ( window.console && window.console.warn && error && rerrorNames.test( error.name ) ) {
		window.console.warn( "jQuery.Deferred exception: " + error.message, error.stack, stack );
	}
};




jQuery.readyException = function( error ) {
	window.setTimeout( function() {
		throw error;
	} );
};




// The deferred used on DOM ready
var readyList = jQuery.Deferred();

jQuery.fn.ready = function( fn ) {

	readyList
		.then( fn )

		// Wrap jQuery.readyException in a function so that the lookup
		// happens at the time of error handling instead of callback
		// registration.
		.catch( function( error ) {
			jQuery.readyException( error );
		} );

	return this;
};

jQuery.extend( {

	// Is the DOM ready to be used? Set to true once it occurs.
	isReady: false,

	// A counter to track how many items to wait for before
	// the ready event fires. See #6781
	readyWait: 1,

	// Hold (or release) the ready event
	holdReady: function( hold ) {
		if ( hold ) {
			jQuery.readyWait++;
		} else {
			jQuery.ready( true );
		}
	},

	// Handle when the DOM is ready
	ready: function( wait ) {

		// Abort if there are pending holds or we're already ready
		if ( wait === true ? --jQuery.readyWait : jQuery.isReady ) {
			return;
		}

		// Remember that the DOM is ready
		jQuery.isReady = true;

		// If a normal DOM Ready event fired, decrement, and wait if need be
		if ( wait !== true && --jQuery.readyWait > 0 ) {
			return;
		}

		// If there are functions bound, to execute
		readyList.resolveWith( document, [ jQuery ] );
	}
} );

jQuery.ready.then = readyList.then;

// The ready event handler and self cleanup method
function completed() {
	document.removeEventListener( "DOMContentLoaded", completed );
	window.removeEventListener( "load", completed );
	jQuery.ready();
}

// Catch cases where $(document).ready() is called
// after the browser event has already occurred.
// Support: IE <=9 - 10 only
// Older IE sometimes signals "interactive" too soon
if ( document.readyState === "complete" ||
	( document.readyState !== "loading" && !document.documentElement.doScroll ) ) {

	// Handle it asynchronously to allow scripts the opportunity to delay ready
	window.setTimeout( jQuery.ready );

} else {

	// Use the handy event callback
	document.addEventListener( "DOMContentLoaded", completed );

	// A fallback to window.onload, that will always work
	window.addEventListener( "load", completed );
}




// Multifunctional method to get and set values of a collection
// The value/s can optionally be executed if it's a function
var access = function( elems, fn, key, value, chainable, emptyGet, raw ) {
	var i = 0,
		len = elems.length,
		bulk = key == null;

	// Sets many values
	if ( jQuery.type( key ) === "object" ) {
		chainable = true;
		for ( i in key ) {
			access( elems, fn, i, key[ i ], true, emptyGet, raw );
		}

	// Sets one value
	} else if ( value !== undefined ) {
		chainable = true;

		if ( !jQuery.isFunction( value ) ) {
			raw = true;
		}

		if ( bulk ) {

			// Bulk operations run against the entire set
			if ( raw ) {
				fn.call( elems, value );
				fn = null;

			// ...except when executing function values
			} else {
				bulk = fn;
				fn = function( elem, key, value ) {
					return bulk.call( jQuery( elem ), value );
				};
			}
		}

		if ( fn ) {
			for ( ; i < len; i++ ) {
				fn(
					elems[ i ], key, raw ?
					value :
					value.call( elems[ i ], i, fn( elems[ i ], key ) )
				);
			}
		}
	}

	if ( chainable ) {
		return elems;
	}

	// Gets
	if ( bulk ) {
		return fn.call( elems );
	}

	return len ? fn( elems[ 0 ], key ) : emptyGet;
};
var acceptData = function( owner ) {

	// Accepts only:
	//  - Node
	//    - Node.ELEMENT_NODE
	//    - Node.DOCUMENT_NODE
	//  - Object
	//    - Any
	return owner.nodeType === 1 || owner.nodeType === 9 || !( +owner.nodeType );
};




function Data() {
	this.expando = jQuery.expando + Data.uid++;
}

Data.uid = 1;

Data.prototype = {

	cache: function( owner ) {

		// Check if the owner object already has a cache
		var value = owner[ this.expando ];

		// If not, create one
		if ( !value ) {
			value = {};

			// We can accept data for non-element nodes in modern browsers,
			// but we should not, see #8335.
			// Always return an empty object.
			if ( acceptData( owner ) ) {

				// If it is a node unlikely to be stringify-ed or looped over
				// use plain assignment
				if ( owner.nodeType ) {
					owner[ this.expando ] = value;

				// Otherwise secure it in a non-enumerable property
				// configurable must be true to allow the property to be
				// deleted when data is removed
				} else {
					Object.defineProperty( owner, this.expando, {
						value: value,
						configurable: true
					} );
				}
			}
		}

		return value;
	},
	set: function( owner, data, value ) {
		var prop,
			cache = this.cache( owner );

		// Handle: [ owner, key, value ] args
		// Always use camelCase key (gh-2257)
		if ( typeof data === "string" ) {
			cache[ jQuery.camelCase( data ) ] = value;

		// Handle: [ owner, { properties } ] args
		} else {

			// Copy the properties one-by-one to the cache object
			for ( prop in data ) {
				cache[ jQuery.camelCase( prop ) ] = data[ prop ];
			}
		}
		return cache;
	},
	get: function( owner, key ) {
		return key === undefined ?
			this.cache( owner ) :

			// Always use camelCase key (gh-2257)
			owner[ this.expando ] && owner[ this.expando ][ jQuery.camelCase( key ) ];
	},
	access: function( owner, key, value ) {

		// In cases where either:
		//
		//   1. No key was specified
		//   2. A string key was specified, but no value provided
		//
		// Take the "read" path and allow the get method to determine
		// which value to return, respectively either:
		//
		//   1. The entire cache object
		//   2. The data stored at the key
		//
		if ( key === undefined ||
				( ( key && typeof key === "string" ) && value === undefined ) ) {

			return this.get( owner, key );
		}

		// When the key is not a string, or both a key and value
		// are specified, set or extend (existing objects) with either:
		//
		//   1. An object of properties
		//   2. A key and value
		//
		this.set( owner, key, value );

		// Since the "set" path can have two possible entry points
		// return the expected data based on which path was taken[*]
		return value !== undefined ? value : key;
	},
	remove: function( owner, key ) {
		var i,
			cache = owner[ this.expando ];

		if ( cache === undefined ) {
			return;
		}

		if ( key !== undefined ) {

			// Support array or space separated string of keys
			if ( jQuery.isArray( key ) ) {

				// If key is an array of keys...
				// We always set camelCase keys, so remove that.
				key = key.map( jQuery.camelCase );
			} else {
				key = jQuery.camelCase( key );

				// If a key with the spaces exists, use it.
				// Otherwise, create an array by matching non-whitespace
				key = key in cache ?
					[ key ] :
					( key.match( rnothtmlwhite ) || [] );
			}

			i = key.length;

			while ( i-- ) {
				delete cache[ key[ i ] ];
			}
		}

		// Remove the expando if there's no more data
		if ( key === undefined || jQuery.isEmptyObject( cache ) ) {

			// Support: Chrome <=35 - 45
			// Webkit & Blink performance suffers when deleting properties
			// from DOM nodes, so set to undefined instead
			// https://bugs.chromium.org/p/chromium/issues/detail?id=378607 (bug restricted)
			if ( owner.nodeType ) {
				owner[ this.expando ] = undefined;
			} else {
				delete owner[ this.expando ];
			}
		}
	},
	hasData: function( owner ) {
		var cache = owner[ this.expando ];
		return cache !== undefined && !jQuery.isEmptyObject( cache );
	}
};
var dataPriv = new Data();

var dataUser = new Data();



//	Implementation Summary
//
//	1. Enforce API surface and semantic compatibility with 1.9.x branch
//	2. Improve the module's maintainability by reducing the storage
//		paths to a single mechanism.
//	3. Use the same single mechanism to support "private" and "user" data.
//	4. _Never_ expose "private" data to user code (TODO: Drop _data, _removeData)
//	5. Avoid exposing implementation details on user objects (eg. expando properties)
//	6. Provide a clear path for implementation upgrade to WeakMap in 2014

var rbrace = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,
	rmultiDash = /[A-Z]/g;

function getData( data ) {
	if ( data === "true" ) {
		return true;
	}

	if ( data === "false" ) {
		return false;
	}

	if ( data === "null" ) {
		return null;
	}

	// Only convert to a number if it doesn't change the string
	if ( data === +data + "" ) {
		return +data;
	}

	if ( rbrace.test( data ) ) {
		return JSON.parse( data );
	}

	return data;
}

function dataAttr( elem, key, data ) {
	var name;

	// If nothing was found internally, try to fetch any
	// data from the HTML5 data-* attribute
	if ( data === undefined && elem.nodeType === 1 ) {
		name = "data-" + key.replace( rmultiDash, "-$&" ).toLowerCase();
		data = elem.getAttribute( name );

		if ( typeof data === "string" ) {
			try {
				data = getData( data );
			} catch ( e ) {}

			// Make sure we set the data so it isn't changed later
			dataUser.set( elem, key, data );
		} else {
			data = undefined;
		}
	}
	return data;
}

jQuery.extend( {
	hasData: function( elem ) {
		return dataUser.hasData( elem ) || dataPriv.hasData( elem );
	},

	data: function( elem, name, data ) {
		return dataUser.access( elem, name, data );
	},

	removeData: function( elem, name ) {
		dataUser.remove( elem, name );
	},

	// TODO: Now that all calls to _data and _removeData have been replaced
	// with direct calls to dataPriv methods, these can be deprecated.
	_data: function( elem, name, data ) {
		return dataPriv.access( elem, name, data );
	},

	_removeData: function( elem, name ) {
		dataPriv.remove( elem, name );
	}
} );

jQuery.fn.extend( {
	data: function( key, value ) {
		var i, name, data,
			elem = this[ 0 ],
			attrs = elem && elem.attributes;

		// Gets all values
		if ( key === undefined ) {
			if ( this.length ) {
				data = dataUser.get( elem );

				if ( elem.nodeType === 1 && !dataPriv.get( elem, "hasDataAttrs" ) ) {
					i = attrs.length;
					while ( i-- ) {

						// Support: IE 11 only
						// The attrs elements can be null (#14894)
						if ( attrs[ i ] ) {
							name = attrs[ i ].name;
							if ( name.indexOf( "data-" ) === 0 ) {
								name = jQuery.camelCase( name.slice( 5 ) );
								dataAttr( elem, name, data[ name ] );
							}
						}
					}
					dataPriv.set( elem, "hasDataAttrs", true );
				}
			}

			return data;
		}

		// Sets multiple values
		if ( typeof key === "object" ) {
			return this.each( function() {
				dataUser.set( this, key );
			} );
		}

		return access( this, function( value ) {
			var data;

			// The calling jQuery object (element matches) is not empty
			// (and therefore has an element appears at this[ 0 ]) and the
			// `value` parameter was not undefined. An empty jQuery object
			// will result in `undefined` for elem = this[ 0 ] which will
			// throw an exception if an attempt to read a data cache is made.
			if ( elem && value === undefined ) {

				// Attempt to get data from the cache
				// The key will always be camelCased in Data
				data = dataUser.get( elem, key );
				if ( data !== undefined ) {
					return data;
				}

				// Attempt to "discover" the data in
				// HTML5 custom data-* attrs
				data = dataAttr( elem, key );
				if ( data !== undefined ) {
					return data;
				}

				// We tried really hard, but the data doesn't exist.
				return;
			}

			// Set the data...
			this.each( function() {

				// We always store the camelCased key
				dataUser.set( this, key, value );
			} );
		}, null, value, arguments.length > 1, null, true );
	},

	removeData: function( key ) {
		return this.each( function() {
			dataUser.remove( this, key );
		} );
	}
} );


jQuery.extend( {
	queue: function( elem, type, data ) {
		var queue;

		if ( elem ) {
			type = ( type || "fx" ) + "queue";
			queue = dataPriv.get( elem, type );

			// Speed up dequeue by getting out quickly if this is just a lookup
			if ( data ) {
				if ( !queue || jQuery.isArray( data ) ) {
					queue = dataPriv.access( elem, type, jQuery.makeArray( data ) );
				} else {
					queue.push( data );
				}
			}
			return queue || [];
		}
	},

	dequeue: function( elem, type ) {
		type = type || "fx";

		var queue = jQuery.queue( elem, type ),
			startLength = queue.length,
			fn = queue.shift(),
			hooks = jQuery._queueHooks( elem, type ),
			next = function() {
				jQuery.dequeue( elem, type );
			};

		// If the fx queue is dequeued, always remove the progress sentinel
		if ( fn === "inprogress" ) {
			fn = queue.shift();
			startLength--;
		}

		if ( fn ) {

			// Add a progress sentinel to prevent the fx queue from being
			// automatically dequeued
			if ( type === "fx" ) {
				queue.unshift( "inprogress" );
			}

			// Clear up the last queue stop function
			delete hooks.stop;
			fn.call( elem, next, hooks );
		}

		if ( !startLength && hooks ) {
			hooks.empty.fire();
		}
	},

	// Not public - generate a queueHooks object, or return the current one
	_queueHooks: function( elem, type ) {
		var key = type + "queueHooks";
		return dataPriv.get( elem, key ) || dataPriv.access( elem, key, {
			empty: jQuery.Callbacks( "once memory" ).add( function() {
				dataPriv.remove( elem, [ type + "queue", key ] );
			} )
		} );
	}
} );

jQuery.fn.extend( {
	queue: function( type, data ) {
		var setter = 2;

		if ( typeof type !== "string" ) {
			data = type;
			type = "fx";
			setter--;
		}

		if ( arguments.length < setter ) {
			return jQuery.queue( this[ 0 ], type );
		}

		return data === undefined ?
			this :
			this.each( function() {
				var queue = jQuery.queue( this, type, data );

				// Ensure a hooks for this queue
				jQuery._queueHooks( this, type );

				if ( type === "fx" && queue[ 0 ] !== "inprogress" ) {
					jQuery.dequeue( this, type );
				}
			} );
	},
	dequeue: function( type ) {
		return this.each( function() {
			jQuery.dequeue( this, type );
		} );
	},
	clearQueue: function( type ) {
		return this.queue( type || "fx", [] );
	},

	// Get a promise resolved when queues of a certain type
	// are emptied (fx is the type by default)
	promise: function( type, obj ) {
		var tmp,
			count = 1,
			defer = jQuery.Deferred(),
			elements = this,
			i = this.length,
			resolve = function() {
				if ( !( --count ) ) {
					defer.resolveWith( elements, [ elements ] );
				}
			};

		if ( typeof type !== "string" ) {
			obj = type;
			type = undefined;
		}
		type = type || "fx";

		while ( i-- ) {
			tmp = dataPriv.get( elements[ i ], type + "queueHooks" );
			if ( tmp && tmp.empty ) {
				count++;
				tmp.empty.add( resolve );
			}
		}
		resolve();
		return defer.promise( obj );
	}
} );
var pnum = ( /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/ ).source;

var rcssNum = new RegExp( "^(?:([+-])=|)(" + pnum + ")([a-z%]*)$", "i" );


var cssExpand = [ "Top", "Right", "Bottom", "Left" ];

var isHiddenWithinTree = function( elem, el ) {

		// isHiddenWithinTree might be called from jQuery#filter function;
		// in that case, element will be second argument
		elem = el || elem;

		// Inline style trumps all
		return elem.style.display === "none" ||
			elem.style.display === "" &&

			// Otherwise, check computed style
			// Support: Firefox <=43 - 45
			// Disconnected elements can have computed display: none, so first confirm that elem is
			// in the document.
			jQuery.contains( elem.ownerDocument, elem ) &&

			jQuery.css( elem, "display" ) === "none";
	};

var swap = function( elem, options, callback, args ) {
	var ret, name,
		old = {};

	// Remember the old values, and insert the new ones
	for ( name in options ) {
		old[ name ] = elem.style[ name ];
		elem.style[ name ] = options[ name ];
	}

	ret = callback.apply( elem, args || [] );

	// Revert the old values
	for ( name in options ) {
		elem.style[ name ] = old[ name ];
	}

	return ret;
};




function adjustCSS( elem, prop, valueParts, tween ) {
	var adjusted,
		scale = 1,
		maxIterations = 20,
		currentValue = tween ?
			function() {
				return tween.cur();
			} :
			function() {
				return jQuery.css( elem, prop, "" );
			},
		initial = currentValue(),
		unit = valueParts && valueParts[ 3 ] || ( jQuery.cssNumber[ prop ] ? "" : "px" ),

		// Starting value computation is required for potential unit mismatches
		initialInUnit = ( jQuery.cssNumber[ prop ] || unit !== "px" && +initial ) &&
			rcssNum.exec( jQuery.css( elem, prop ) );

	if ( initialInUnit && initialInUnit[ 3 ] !== unit ) {

		// Trust units reported by jQuery.css
		unit = unit || initialInUnit[ 3 ];

		// Make sure we update the tween properties later on
		valueParts = valueParts || [];

		// Iteratively approximate from a nonzero starting point
		initialInUnit = +initial || 1;

		do {

			// If previous iteration zeroed out, double until we get *something*.
			// Use string for doubling so we don't accidentally see scale as unchanged below
			scale = scale || ".5";

			// Adjust and apply
			initialInUnit = initialInUnit / scale;
			jQuery.style( elem, prop, initialInUnit + unit );

		// Update scale, tolerating zero or NaN from tween.cur()
		// Break the loop if scale is unchanged or perfect, or if we've just had enough.
		} while (
			scale !== ( scale = currentValue() / initial ) && scale !== 1 && --maxIterations
		);
	}

	if ( valueParts ) {
		initialInUnit = +initialInUnit || +initial || 0;

		// Apply relative offset (+=/-=) if specified
		adjusted = valueParts[ 1 ] ?
			initialInUnit + ( valueParts[ 1 ] + 1 ) * valueParts[ 2 ] :
			+valueParts[ 2 ];
		if ( tween ) {
			tween.unit = unit;
			tween.start = initialInUnit;
			tween.end = adjusted;
		}
	}
	return adjusted;
}


var defaultDisplayMap = {};

function getDefaultDisplay( elem ) {
	var temp,
		doc = elem.ownerDocument,
		nodeName = elem.nodeName,
		display = defaultDisplayMap[ nodeName ];

	if ( display ) {
		return display;
	}

	temp = doc.body.appendChild( doc.createElement( nodeName ) );
	display = jQuery.css( temp, "display" );

	temp.parentNode.removeChild( temp );

	if ( display === "none" ) {
		display = "block";
	}
	defaultDisplayMap[ nodeName ] = display;

	return display;
}

function showHide( elements, show ) {
	var display, elem,
		values = [],
		index = 0,
		length = elements.length;

	// Determine new display value for elements that need to change
	for ( ; index < length; index++ ) {
		elem = elements[ index ];
		if ( !elem.style ) {
			continue;
		}

		display = elem.style.display;
		if ( show ) {

			// Since we force visibility upon cascade-hidden elements, an immediate (and slow)
			// check is required in this first loop unless we have a nonempty display value (either
			// inline or about-to-be-restored)
			if ( display === "none" ) {
				values[ index ] = dataPriv.get( elem, "display" ) || null;
				if ( !values[ index ] ) {
					elem.style.display = "";
				}
			}
			if ( elem.style.display === "" && isHiddenWithinTree( elem ) ) {
				values[ index ] = getDefaultDisplay( elem );
			}
		} else {
			if ( display !== "none" ) {
				values[ index ] = "none";

				// Remember what we're overwriting
				dataPriv.set( elem, "display", display );
			}
		}
	}

	// Set the display of the elements in a second loop to avoid constant reflow
	for ( index = 0; index < length; index++ ) {
		if ( values[ index ] != null ) {
			elements[ index ].style.display = values[ index ];
		}
	}

	return elements;
}

jQuery.fn.extend( {
	show: function() {
		return showHide( this, true );
	},
	hide: function() {
		return showHide( this );
	},
	toggle: function( state ) {
		if ( typeof state === "boolean" ) {
			return state ? this.show() : this.hide();
		}

		return this.each( function() {
			if ( isHiddenWithinTree( this ) ) {
				jQuery( this ).show();
			} else {
				jQuery( this ).hide();
			}
		} );
	}
} );
var rcheckableType = ( /^(?:checkbox|radio)$/i );

var rtagName = ( /<([a-z][^\/\0>\x20\t\r\n\f]+)/i );

var rscriptType = ( /^$|\/(?:java|ecma)script/i );



// We have to close these tags to support XHTML (#13200)
var wrapMap = {

	// Support: IE <=9 only
	option: [ 1, "<select multiple='multiple'>", "</select>" ],

	// XHTML parsers do not magically insert elements in the
	// same way that tag soup parsers do. So we cannot shorten
	// this by omitting <tbody> or other required elements.
	thead: [ 1, "<table>", "</table>" ],
	col: [ 2, "<table><colgroup>", "</colgroup></table>" ],
	tr: [ 2, "<table><tbody>", "</tbody></table>" ],
	td: [ 3, "<table><tbody><tr>", "</tr></tbody></table>" ],

	_default: [ 0, "", "" ]
};

// Support: IE <=9 only
wrapMap.optgroup = wrapMap.option;

wrapMap.tbody = wrapMap.tfoot = wrapMap.colgroup = wrapMap.caption = wrapMap.thead;
wrapMap.th = wrapMap.td;


function getAll( context, tag ) {

	// Support: IE <=9 - 11 only
	// Use typeof to avoid zero-argument method invocation on host objects (#15151)
	var ret;

	if ( typeof context.getElementsByTagName !== "undefined" ) {
		ret = context.getElementsByTagName( tag || "*" );

	} else if ( typeof context.querySelectorAll !== "undefined" ) {
		ret = context.querySelectorAll( tag || "*" );

	} else {
		ret = [];
	}

	if ( tag === undefined || tag && jQuery.nodeName( context, tag ) ) {
		return jQuery.merge( [ context ], ret );
	}

	return ret;
}


// Mark scripts as having already been evaluated
function setGlobalEval( elems, refElements ) {
	var i = 0,
		l = elems.length;

	for ( ; i < l; i++ ) {
		dataPriv.set(
			elems[ i ],
			"globalEval",
			!refElements || dataPriv.get( refElements[ i ], "globalEval" )
		);
	}
}


var rhtml = /<|&#?\w+;/;

function buildFragment( elems, context, scripts, selection, ignored ) {
	var elem, tmp, tag, wrap, contains, j,
		fragment = context.createDocumentFragment(),
		nodes = [],
		i = 0,
		l = elems.length;

	for ( ; i < l; i++ ) {
		elem = elems[ i ];

		if ( elem || elem === 0 ) {

			// Add nodes directly
			if ( jQuery.type( elem ) === "object" ) {

				// Support: Android <=4.0 only, PhantomJS 1 only
				// push.apply(_, arraylike) throws on ancient WebKit
				jQuery.merge( nodes, elem.nodeType ? [ elem ] : elem );

			// Convert non-html into a text node
			} else if ( !rhtml.test( elem ) ) {
				nodes.push( context.createTextNode( elem ) );

			// Convert html into DOM nodes
			} else {
				tmp = tmp || fragment.appendChild( context.createElement( "div" ) );

				// Deserialize a standard representation
				tag = ( rtagName.exec( elem ) || [ "", "" ] )[ 1 ].toLowerCase();
				wrap = wrapMap[ tag ] || wrapMap._default;
				tmp.innerHTML = wrap[ 1 ] + jQuery.htmlPrefilter( elem ) + wrap[ 2 ];

				// Descend through wrappers to the right content
				j = wrap[ 0 ];
				while ( j-- ) {
					tmp = tmp.lastChild;
				}

				// Support: Android <=4.0 only, PhantomJS 1 only
				// push.apply(_, arraylike) throws on ancient WebKit
				jQuery.merge( nodes, tmp.childNodes );

				// Remember the top-level container
				tmp = fragment.firstChild;

				// Ensure the created nodes are orphaned (#12392)
				tmp.textContent = "";
			}
		}
	}

	// Remove wrapper from fragment
	fragment.textContent = "";

	i = 0;
	while ( ( elem = nodes[ i++ ] ) ) {

		// Skip elements already in the context collection (trac-4087)
		if ( selection && jQuery.inArray( elem, selection ) > -1 ) {
			if ( ignored ) {
				ignored.push( elem );
			}
			continue;
		}

		contains = jQuery.contains( elem.ownerDocument, elem );

		// Append to fragment
		tmp = getAll( fragment.appendChild( elem ), "script" );

		// Preserve script evaluation history
		if ( contains ) {
			setGlobalEval( tmp );
		}

		// Capture executables
		if ( scripts ) {
			j = 0;
			while ( ( elem = tmp[ j++ ] ) ) {
				if ( rscriptType.test( elem.type || "" ) ) {
					scripts.push( elem );
				}
			}
		}
	}

	return fragment;
}


( function() {
	var fragment = document.createDocumentFragment(),
		div = fragment.appendChild( document.createElement( "div" ) ),
		input = document.createElement( "input" );

	// Support: Android 4.0 - 4.3 only
	// Check state lost if the name is set (#11217)
	// Support: Windows Web Apps (WWA)
	// `name` and `type` must use .setAttribute for WWA (#14901)
	input.setAttribute( "type", "radio" );
	input.setAttribute( "checked", "checked" );
	input.setAttribute( "name", "t" );

	div.appendChild( input );

	// Support: Android <=4.1 only
	// Older WebKit doesn't clone checked state correctly in fragments
	support.checkClone = div.cloneNode( true ).cloneNode( true ).lastChild.checked;

	// Support: IE <=11 only
	// Make sure textarea (and checkbox) defaultValue is properly cloned
	div.innerHTML = "<textarea>x</textarea>";
	support.noCloneChecked = !!div.cloneNode( true ).lastChild.defaultValue;
} )();
var documentElement = document.documentElement;



var
	rkeyEvent = /^key/,
	rmouseEvent = /^(?:mouse|pointer|contextmenu|drag|drop)|click/,
	rtypenamespace = /^([^.]*)(?:\.(.+)|)/;

function returnTrue() {
	return true;
}

function returnFalse() {
	return false;
}

// Support: IE <=9 only
// See #13393 for more info
function safeActiveElement() {
	try {
		return document.activeElement;
	} catch ( err ) { }
}

function on( elem, types, selector, data, fn, one ) {
	var origFn, type;

	// Types can be a map of types/handlers
	if ( typeof types === "object" ) {

		// ( types-Object, selector, data )
		if ( typeof selector !== "string" ) {

			// ( types-Object, data )
			data = data || selector;
			selector = undefined;
		}
		for ( type in types ) {
			on( elem, type, selector, data, types[ type ], one );
		}
		return elem;
	}

	if ( data == null && fn == null ) {

		// ( types, fn )
		fn = selector;
		data = selector = undefined;
	} else if ( fn == null ) {
		if ( typeof selector === "string" ) {

			// ( types, selector, fn )
			fn = data;
			data = undefined;
		} else {

			// ( types, data, fn )
			fn = data;
			data = selector;
			selector = undefined;
		}
	}
	if ( fn === false ) {
		fn = returnFalse;
	} else if ( !fn ) {
		return elem;
	}

	if ( one === 1 ) {
		origFn = fn;
		fn = function( event ) {

			// Can use an empty set, since event contains the info
			jQuery().off( event );
			return origFn.apply( this, arguments );
		};

		// Use same guid so caller can remove using origFn
		fn.guid = origFn.guid || ( origFn.guid = jQuery.guid++ );
	}
	return elem.each( function() {
		jQuery.event.add( this, types, fn, data, selector );
	} );
}

/*
 * Helper functions for managing events -- not part of the public interface.
 * Props to Dean Edwards' addEvent library for many of the ideas.
 */
jQuery.event = {

	global: {},

	add: function( elem, types, handler, data, selector ) {

		var handleObjIn, eventHandle, tmp,
			events, t, handleObj,
			special, handlers, type, namespaces, origType,
			elemData = dataPriv.get( elem );

		// Don't attach events to noData or text/comment nodes (but allow plain objects)
		if ( !elemData ) {
			return;
		}

		// Caller can pass in an object of custom data in lieu of the handler
		if ( handler.handler ) {
			handleObjIn = handler;
			handler = handleObjIn.handler;
			selector = handleObjIn.selector;
		}

		// Ensure that invalid selectors throw exceptions at attach time
		// Evaluate against documentElement in case elem is a non-element node (e.g., document)
		if ( selector ) {
			jQuery.find.matchesSelector( documentElement, selector );
		}

		// Make sure that the handler has a unique ID, used to find/remove it later
		if ( !handler.guid ) {
			handler.guid = jQuery.guid++;
		}

		// Init the element's event structure and main handler, if this is the first
		if ( !( events = elemData.events ) ) {
			events = elemData.events = {};
		}
		if ( !( eventHandle = elemData.handle ) ) {
			eventHandle = elemData.handle = function( e ) {

				// Discard the second event of a jQuery.event.trigger() and
				// when an event is called after a page has unloaded
				return typeof jQuery !== "undefined" && jQuery.event.triggered !== e.type ?
					jQuery.event.dispatch.apply( elem, arguments ) : undefined;
			};
		}

		// Handle multiple events separated by a space
		types = ( types || "" ).match( rnothtmlwhite ) || [ "" ];
		t = types.length;
		while ( t-- ) {
			tmp = rtypenamespace.exec( types[ t ] ) || [];
			type = origType = tmp[ 1 ];
			namespaces = ( tmp[ 2 ] || "" ).split( "." ).sort();

			// There *must* be a type, no attaching namespace-only handlers
			if ( !type ) {
				continue;
			}

			// If event changes its type, use the special event handlers for the changed type
			special = jQuery.event.special[ type ] || {};

			// If selector defined, determine special event api type, otherwise given type
			type = ( selector ? special.delegateType : special.bindType ) || type;

			// Update special based on newly reset type
			special = jQuery.event.special[ type ] || {};

			// handleObj is passed to all event handlers
			handleObj = jQuery.extend( {
				type: type,
				origType: origType,
				data: data,
				handler: handler,
				guid: handler.guid,
				selector: selector,
				needsContext: selector && jQuery.expr.match.needsContext.test( selector ),
				namespace: namespaces.join( "." )
			}, handleObjIn );

			// Init the event handler queue if we're the first
			if ( !( handlers = events[ type ] ) ) {
				handlers = events[ type ] = [];
				handlers.delegateCount = 0;

				// Only use addEventListener if the special events handler returns false
				if ( !special.setup ||
					special.setup.call( elem, data, namespaces, eventHandle ) === false ) {

					if ( elem.addEventListener ) {
						elem.addEventListener( type, eventHandle );
					}
				}
			}

			if ( special.add ) {
				special.add.call( elem, handleObj );

				if ( !handleObj.handler.guid ) {
					handleObj.handler.guid = handler.guid;
				}
			}

			// Add to the element's handler list, delegates in front
			if ( selector ) {
				handlers.splice( handlers.delegateCount++, 0, handleObj );
			} else {
				handlers.push( handleObj );
			}

			// Keep track of which events have ever been used, for event optimization
			jQuery.event.global[ type ] = true;
		}

	},

	// Detach an event or set of events from an element
	remove: function( elem, types, handler, selector, mappedTypes ) {

		var j, origCount, tmp,
			events, t, handleObj,
			special, handlers, type, namespaces, origType,
			elemData = dataPriv.hasData( elem ) && dataPriv.get( elem );

		if ( !elemData || !( events = elemData.events ) ) {
			return;
		}

		// Once for each type.namespace in types; type may be omitted
		types = ( types || "" ).match( rnothtmlwhite ) || [ "" ];
		t = types.length;
		while ( t-- ) {
			tmp = rtypenamespace.exec( types[ t ] ) || [];
			type = origType = tmp[ 1 ];
			namespaces = ( tmp[ 2 ] || "" ).split( "." ).sort();

			// Unbind all events (on this namespace, if provided) for the element
			if ( !type ) {
				for ( type in events ) {
					jQuery.event.remove( elem, type + types[ t ], handler, selector, true );
				}
				continue;
			}

			special = jQuery.event.special[ type ] || {};
			type = ( selector ? special.delegateType : special.bindType ) || type;
			handlers = events[ type ] || [];
			tmp = tmp[ 2 ] &&
				new RegExp( "(^|\\.)" + namespaces.join( "\\.(?:.*\\.|)" ) + "(\\.|$)" );

			// Remove matching events
			origCount = j = handlers.length;
			while ( j-- ) {
				handleObj = handlers[ j ];

				if ( ( mappedTypes || origType === handleObj.origType ) &&
					( !handler || handler.guid === handleObj.guid ) &&
					( !tmp || tmp.test( handleObj.namespace ) ) &&
					( !selector || selector === handleObj.selector ||
						selector === "**" && handleObj.selector ) ) {
					handlers.splice( j, 1 );

					if ( handleObj.selector ) {
						handlers.delegateCount--;
					}
					if ( special.remove ) {
						special.remove.call( elem, handleObj );
					}
				}
			}

			// Remove generic event handler if we removed something and no more handlers exist
			// (avoids potential for endless recursion during removal of special event handlers)
			if ( origCount && !handlers.length ) {
				if ( !special.teardown ||
					special.teardown.call( elem, namespaces, elemData.handle ) === false ) {

					jQuery.removeEvent( elem, type, elemData.handle );
				}

				delete events[ type ];
			}
		}

		// Remove data and the expando if it's no longer used
		if ( jQuery.isEmptyObject( events ) ) {
			dataPriv.remove( elem, "handle events" );
		}
	},

	dispatch: function( nativeEvent ) {

		// Make a writable jQuery.Event from the native event object
		var event = jQuery.event.fix( nativeEvent );

		var i, j, ret, matched, handleObj, handlerQueue,
			args = new Array( arguments.length ),
			handlers = ( dataPriv.get( this, "events" ) || {} )[ event.type ] || [],
			special = jQuery.event.special[ event.type ] || {};

		// Use the fix-ed jQuery.Event rather than the (read-only) native event
		args[ 0 ] = event;

		for ( i = 1; i < arguments.length; i++ ) {
			args[ i ] = arguments[ i ];
		}

		event.delegateTarget = this;

		// Call the preDispatch hook for the mapped type, and let it bail if desired
		if ( special.preDispatch && special.preDispatch.call( this, event ) === false ) {
			return;
		}

		// Determine handlers
		handlerQueue = jQuery.event.handlers.call( this, event, handlers );

		// Run delegates first; they may want to stop propagation beneath us
		i = 0;
		while ( ( matched = handlerQueue[ i++ ] ) && !event.isPropagationStopped() ) {
			event.currentTarget = matched.elem;

			j = 0;
			while ( ( handleObj = matched.handlers[ j++ ] ) &&
				!event.isImmediatePropagationStopped() ) {

				// Triggered event must either 1) have no namespace, or 2) have namespace(s)
				// a subset or equal to those in the bound event (both can have no namespace).
				if ( !event.rnamespace || event.rnamespace.test( handleObj.namespace ) ) {

					event.handleObj = handleObj;
					event.data = handleObj.data;

					ret = ( ( jQuery.event.special[ handleObj.origType ] || {} ).handle ||
						handleObj.handler ).apply( matched.elem, args );

					if ( ret !== undefined ) {
						if ( ( event.result = ret ) === false ) {
							event.preventDefault();
							event.stopPropagation();
						}
					}
				}
			}
		}

		// Call the postDispatch hook for the mapped type
		if ( special.postDispatch ) {
			special.postDispatch.call( this, event );
		}

		return event.result;
	},

	handlers: function( event, handlers ) {
		var i, handleObj, sel, matchedHandlers, matchedSelectors,
			handlerQueue = [],
			delegateCount = handlers.delegateCount,
			cur = event.target;

		// Find delegate handlers
		if ( delegateCount &&

			// Support: IE <=9
			// Black-hole SVG <use> instance trees (trac-13180)
			cur.nodeType &&

			// Support: Firefox <=42
			// Suppress spec-violating clicks indicating a non-primary pointer button (trac-3861)
			// https://www.w3.org/TR/DOM-Level-3-Events/#event-type-click
			// Support: IE 11 only
			// ...but not arrow key "clicks" of radio inputs, which can have `button` -1 (gh-2343)
			!( event.type === "click" && event.button >= 1 ) ) {

			for ( ; cur !== this; cur = cur.parentNode || this ) {

				// Don't check non-elements (#13208)
				// Don't process clicks on disabled elements (#6911, #8165, #11382, #11764)
				if ( cur.nodeType === 1 && !( event.type === "click" && cur.disabled === true ) ) {
					matchedHandlers = [];
					matchedSelectors = {};
					for ( i = 0; i < delegateCount; i++ ) {
						handleObj = handlers[ i ];

						// Don't conflict with Object.prototype properties (#13203)
						sel = handleObj.selector + " ";

						if ( matchedSelectors[ sel ] === undefined ) {
							matchedSelectors[ sel ] = handleObj.needsContext ?
								jQuery( sel, this ).index( cur ) > -1 :
								jQuery.find( sel, this, null, [ cur ] ).length;
						}
						if ( matchedSelectors[ sel ] ) {
							matchedHandlers.push( handleObj );
						}
					}
					if ( matchedHandlers.length ) {
						handlerQueue.push( { elem: cur, handlers: matchedHandlers } );
					}
				}
			}
		}

		// Add the remaining (directly-bound) handlers
		cur = this;
		if ( delegateCount < handlers.length ) {
			handlerQueue.push( { elem: cur, handlers: handlers.slice( delegateCount ) } );
		}

		return handlerQueue;
	},

	addProp: function( name, hook ) {
		Object.defineProperty( jQuery.Event.prototype, name, {
			enumerable: true,
			configurable: true,

			get: jQuery.isFunction( hook ) ?
				function() {
					if ( this.originalEvent ) {
							return hook( this.originalEvent );
					}
				} :
				function() {
					if ( this.originalEvent ) {
							return this.originalEvent[ name ];
					}
				},

			set: function( value ) {
				Object.defineProperty( this, name, {
					enumerable: true,
					configurable: true,
					writable: true,
					value: value
				} );
			}
		} );
	},

	fix: function( originalEvent ) {
		return originalEvent[ jQuery.expando ] ?
			originalEvent :
			new jQuery.Event( originalEvent );
	},

	special: {
		load: {

			// Prevent triggered image.load events from bubbling to window.load
			noBubble: true
		},
		focus: {

			// Fire native event if possible so blur/focus sequence is correct
			trigger: function() {
				if ( this !== safeActiveElement() && this.focus ) {
					this.focus();
					return false;
				}
			},
			delegateType: "focusin"
		},
		blur: {
			trigger: function() {
				if ( this === safeActiveElement() && this.blur ) {
					this.blur();
					return false;
				}
			},
			delegateType: "focusout"
		},
		click: {

			// For checkbox, fire native event so checked state will be right
			trigger: function() {
				if ( this.type === "checkbox" && this.click && jQuery.nodeName( this, "input" ) ) {
					this.click();
					return false;
				}
			},

			// For cross-browser consistency, don't fire native .click() on links
			_default: function( event ) {
				return jQuery.nodeName( event.target, "a" );
			}
		},

		beforeunload: {
			postDispatch: function( event ) {

				// Support: Firefox 20+
				// Firefox doesn't alert if the returnValue field is not set.
				if ( event.result !== undefined && event.originalEvent ) {
					event.originalEvent.returnValue = event.result;
				}
			}
		}
	}
};

jQuery.removeEvent = function( elem, type, handle ) {

	// This "if" is needed for plain objects
	if ( elem.removeEventListener ) {
		elem.removeEventListener( type, handle );
	}
};

jQuery.Event = function( src, props ) {

	// Allow instantiation without the 'new' keyword
	if ( !( this instanceof jQuery.Event ) ) {
		return new jQuery.Event( src, props );
	}

	// Event object
	if ( src && src.type ) {
		this.originalEvent = src;
		this.type = src.type;

		// Events bubbling up the document may have been marked as prevented
		// by a handler lower down the tree; reflect the correct value.
		this.isDefaultPrevented = src.defaultPrevented ||
				src.defaultPrevented === undefined &&

				// Support: Android <=2.3 only
				src.returnValue === false ?
			returnTrue :
			returnFalse;

		// Create target properties
		// Support: Safari <=6 - 7 only
		// Target should not be a text node (#504, #13143)
		this.target = ( src.target && src.target.nodeType === 3 ) ?
			src.target.parentNode :
			src.target;

		this.currentTarget = src.currentTarget;
		this.relatedTarget = src.relatedTarget;

	// Event type
	} else {
		this.type = src;
	}

	// Put explicitly provided properties onto the event object
	if ( props ) {
		jQuery.extend( this, props );
	}

	// Create a timestamp if incoming event doesn't have one
	this.timeStamp = src && src.timeStamp || jQuery.now();

	// Mark it as fixed
	this[ jQuery.expando ] = true;
};

// jQuery.Event is based on DOM3 Events as specified by the ECMAScript Language Binding
// https://www.w3.org/TR/2003/WD-DOM-Level-3-Events-20030331/ecma-script-binding.html
jQuery.Event.prototype = {
	constructor: jQuery.Event,
	isDefaultPrevented: returnFalse,
	isPropagationStopped: returnFalse,
	isImmediatePropagationStopped: returnFalse,
	isSimulated: false,

	preventDefault: function() {
		var e = this.originalEvent;

		this.isDefaultPrevented = returnTrue;

		if ( e && !this.isSimulated ) {
			e.preventDefault();
		}
	},
	stopPropagation: function() {
		var e = this.originalEvent;

		this.isPropagationStopped = returnTrue;

		if ( e && !this.isSimulated ) {
			e.stopPropagation();
		}
	},
	stopImmediatePropagation: function() {
		var e = this.originalEvent;

		this.isImmediatePropagationStopped = returnTrue;

		if ( e && !this.isSimulated ) {
			e.stopImmediatePropagation();
		}

		this.stopPropagation();
	}
};

// Includes all common event props including KeyEvent and MouseEvent specific props
jQuery.each( {
	altKey: true,
	bubbles: true,
	cancelable: true,
	changedTouches: true,
	ctrlKey: true,
	detail: true,
	eventPhase: true,
	metaKey: true,
	pageX: true,
	pageY: true,
	shiftKey: true,
	view: true,
	"char": true,
	charCode: true,
	key: true,
	keyCode: true,
	button: true,
	buttons: true,
	clientX: true,
	clientY: true,
	offsetX: true,
	offsetY: true,
	pointerId: true,
	pointerType: true,
	screenX: true,
	screenY: true,
	targetTouches: true,
	toElement: true,
	touches: true,

	which: function( event ) {
		var button = event.button;

		// Add which for key events
		if ( event.which == null && rkeyEvent.test( event.type ) ) {
			return event.charCode != null ? event.charCode : event.keyCode;
		}

		// Add which for click: 1 === left; 2 === middle; 3 === right
		if ( !event.which && button !== undefined && rmouseEvent.test( event.type ) ) {
			if ( button & 1 ) {
				return 1;
			}

			if ( button & 2 ) {
				return 3;
			}

			if ( button & 4 ) {
				return 2;
			}

			return 0;
		}

		return event.which;
	}
}, jQuery.event.addProp );

// Create mouseenter/leave events using mouseover/out and event-time checks
// so that event delegation works in jQuery.
// Do the same for pointerenter/pointerleave and pointerover/pointerout
//
// Support: Safari 7 only
// Safari sends mouseenter too often; see:
// https://bugs.chromium.org/p/chromium/issues/detail?id=470258
// for the description of the bug (it existed in older Chrome versions as well).
jQuery.each( {
	mouseenter: "mouseover",
	mouseleave: "mouseout",
	pointerenter: "pointerover",
	pointerleave: "pointerout"
}, function( orig, fix ) {
	jQuery.event.special[ orig ] = {
		delegateType: fix,
		bindType: fix,

		handle: function( event ) {
			var ret,
				target = this,
				related = event.relatedTarget,
				handleObj = event.handleObj;

			// For mouseenter/leave call the handler if related is outside the target.
			// NB: No relatedTarget if the mouse left/entered the browser window
			if ( !related || ( related !== target && !jQuery.contains( target, related ) ) ) {
				event.type = handleObj.origType;
				ret = handleObj.handler.apply( this, arguments );
				event.type = fix;
			}
			return ret;
		}
	};
} );

jQuery.fn.extend( {

	on: function( types, selector, data, fn ) {
		return on( this, types, selector, data, fn );
	},
	one: function( types, selector, data, fn ) {
		return on( this, types, selector, data, fn, 1 );
	},
	off: function( types, selector, fn ) {
		var handleObj, type;
		if ( types && types.preventDefault && types.handleObj ) {

			// ( event )  dispatched jQuery.Event
			handleObj = types.handleObj;
			jQuery( types.delegateTarget ).off(
				handleObj.namespace ?
					handleObj.origType + "." + handleObj.namespace :
					handleObj.origType,
				handleObj.selector,
				handleObj.handler
			);
			return this;
		}
		if ( typeof types === "object" ) {

			// ( types-object [, selector] )
			for ( type in types ) {
				this.off( type, selector, types[ type ] );
			}
			return this;
		}
		if ( selector === false || typeof selector === "function" ) {

			// ( types [, fn] )
			fn = selector;
			selector = undefined;
		}
		if ( fn === false ) {
			fn = returnFalse;
		}
		return this.each( function() {
			jQuery.event.remove( this, types, fn, selector );
		} );
	}
} );


var

	/* eslint-disable max-len */

	// See https://github.com/eslint/eslint/issues/3229
	rxhtmlTag = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([a-z][^\/\0>\x20\t\r\n\f]*)[^>]*)\/>/gi,

	/* eslint-enable */

	// Support: IE <=10 - 11, Edge 12 - 13
	// In IE/Edge using regex groups here causes severe slowdowns.
	// See https://connect.microsoft.com/IE/feedback/details/1736512/
	rnoInnerhtml = /<script|<style|<link/i,

	// checked="checked" or checked
	rchecked = /checked\s*(?:[^=]|=\s*.checked.)/i,
	rscriptTypeMasked = /^true\/(.*)/,
	rcleanScript = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g;

function manipulationTarget( elem, content ) {
	if ( jQuery.nodeName( elem, "table" ) &&
		jQuery.nodeName( content.nodeType !== 11 ? content : content.firstChild, "tr" ) ) {

		return elem.getElementsByTagName( "tbody" )[ 0 ] || elem;
	}

	return elem;
}

// Replace/restore the type attribute of script elements for safe DOM manipulation
function disableScript( elem ) {
	elem.type = ( elem.getAttribute( "type" ) !== null ) + "/" + elem.type;
	return elem;
}
function restoreScript( elem ) {
	var match = rscriptTypeMasked.exec( elem.type );

	if ( match ) {
		elem.type = match[ 1 ];
	} else {
		elem.removeAttribute( "type" );
	}

	return elem;
}

function cloneCopyEvent( src, dest ) {
	var i, l, type, pdataOld, pdataCur, udataOld, udataCur, events;

	if ( dest.nodeType !== 1 ) {
		return;
	}

	// 1. Copy private data: events, handlers, etc.
	if ( dataPriv.hasData( src ) ) {
		pdataOld = dataPriv.access( src );
		pdataCur = dataPriv.set( dest, pdataOld );
		events = pdataOld.events;

		if ( events ) {
			delete pdataCur.handle;
			pdataCur.events = {};

			for ( type in events ) {
				for ( i = 0, l = events[ type ].length; i < l; i++ ) {
					jQuery.event.add( dest, type, events[ type ][ i ] );
				}
			}
		}
	}

	// 2. Copy user data
	if ( dataUser.hasData( src ) ) {
		udataOld = dataUser.access( src );
		udataCur = jQuery.extend( {}, udataOld );

		dataUser.set( dest, udataCur );
	}
}

// Fix IE bugs, see support tests
function fixInput( src, dest ) {
	var nodeName = dest.nodeName.toLowerCase();

	// Fails to persist the checked state of a cloned checkbox or radio button.
	if ( nodeName === "input" && rcheckableType.test( src.type ) ) {
		dest.checked = src.checked;

	// Fails to return the selected option to the default selected state when cloning options
	} else if ( nodeName === "input" || nodeName === "textarea" ) {
		dest.defaultValue = src.defaultValue;
	}
}

function domManip( collection, args, callback, ignored ) {

	// Flatten any nested arrays
	args = concat.apply( [], args );

	var fragment, first, scripts, hasScripts, node, doc,
		i = 0,
		l = collection.length,
		iNoClone = l - 1,
		value = args[ 0 ],
		isFunction = jQuery.isFunction( value );

	// We can't cloneNode fragments that contain checked, in WebKit
	if ( isFunction ||
			( l > 1 && typeof value === "string" &&
				!support.checkClone && rchecked.test( value ) ) ) {
		return collection.each( function( index ) {
			var self = collection.eq( index );
			if ( isFunction ) {
				args[ 0 ] = value.call( this, index, self.html() );
			}
			domManip( self, args, callback, ignored );
		} );
	}

	if ( l ) {
		fragment = buildFragment( args, collection[ 0 ].ownerDocument, false, collection, ignored );
		first = fragment.firstChild;

		if ( fragment.childNodes.length === 1 ) {
			fragment = first;
		}

		// Require either new content or an interest in ignored elements to invoke the callback
		if ( first || ignored ) {
			scripts = jQuery.map( getAll( fragment, "script" ), disableScript );
			hasScripts = scripts.length;

			// Use the original fragment for the last item
			// instead of the first because it can end up
			// being emptied incorrectly in certain situations (#8070).
			for ( ; i < l; i++ ) {
				node = fragment;

				if ( i !== iNoClone ) {
					node = jQuery.clone( node, true, true );

					// Keep references to cloned scripts for later restoration
					if ( hasScripts ) {

						// Support: Android <=4.0 only, PhantomJS 1 only
						// push.apply(_, arraylike) throws on ancient WebKit
						jQuery.merge( scripts, getAll( node, "script" ) );
					}
				}

				callback.call( collection[ i ], node, i );
			}

			if ( hasScripts ) {
				doc = scripts[ scripts.length - 1 ].ownerDocument;

				// Reenable scripts
				jQuery.map( scripts, restoreScript );

				// Evaluate executable scripts on first document insertion
				for ( i = 0; i < hasScripts; i++ ) {
					node = scripts[ i ];
					if ( rscriptType.test( node.type || "" ) &&
						!dataPriv.access( node, "globalEval" ) &&
						jQuery.contains( doc, node ) ) {

						if ( node.src ) {

							// Optional AJAX dependency, but won't run scripts if not present
							if ( jQuery._evalUrl ) {
								jQuery._evalUrl( node.src );
							}
						} else {
							DOMEval( node.textContent.replace( rcleanScript, "" ), doc );
						}
					}
				}
			}
		}
	}

	return collection;
}

function remove( elem, selector, keepData ) {
	var node,
		nodes = selector ? jQuery.filter( selector, elem ) : elem,
		i = 0;

	for ( ; ( node = nodes[ i ] ) != null; i++ ) {
		if ( !keepData && node.nodeType === 1 ) {
			jQuery.cleanData( getAll( node ) );
		}

		if ( node.parentNode ) {
			if ( keepData && jQuery.contains( node.ownerDocument, node ) ) {
				setGlobalEval( getAll( node, "script" ) );
			}
			node.parentNode.removeChild( node );
		}
	}

	return elem;
}

jQuery.extend( {
	htmlPrefilter: function( html ) {
		return html.replace( rxhtmlTag, "<$1></$2>" );
	},

	clone: function( elem, dataAndEvents, deepDataAndEvents ) {
		var i, l, srcElements, destElements,
			clone = elem.cloneNode( true ),
			inPage = jQuery.contains( elem.ownerDocument, elem );

		// Fix IE cloning issues
		if ( !support.noCloneChecked && ( elem.nodeType === 1 || elem.nodeType === 11 ) &&
				!jQuery.isXMLDoc( elem ) ) {

			// We eschew Sizzle here for performance reasons: https://jsperf.com/getall-vs-sizzle/2
			destElements = getAll( clone );
			srcElements = getAll( elem );

			for ( i = 0, l = srcElements.length; i < l; i++ ) {
				fixInput( srcElements[ i ], destElements[ i ] );
			}
		}

		// Copy the events from the original to the clone
		if ( dataAndEvents ) {
			if ( deepDataAndEvents ) {
				srcElements = srcElements || getAll( elem );
				destElements = destElements || getAll( clone );

				for ( i = 0, l = srcElements.length; i < l; i++ ) {
					cloneCopyEvent( srcElements[ i ], destElements[ i ] );
				}
			} else {
				cloneCopyEvent( elem, clone );
			}
		}

		// Preserve script evaluation history
		destElements = getAll( clone, "script" );
		if ( destElements.length > 0 ) {
			setGlobalEval( destElements, !inPage && getAll( elem, "script" ) );
		}

		// Return the cloned set
		return clone;
	},

	cleanData: function( elems ) {
		var data, elem, type,
			special = jQuery.event.special,
			i = 0;

		for ( ; ( elem = elems[ i ] ) !== undefined; i++ ) {
			if ( acceptData( elem ) ) {
				if ( ( data = elem[ dataPriv.expando ] ) ) {
					if ( data.events ) {
						for ( type in data.events ) {
							if ( special[ type ] ) {
								jQuery.event.remove( elem, type );

							// This is a shortcut to avoid jQuery.event.remove's overhead
							} else {
								jQuery.removeEvent( elem, type, data.handle );
							}
						}
					}

					// Support: Chrome <=35 - 45+
					// Assign undefined instead of using delete, see Data#remove
					elem[ dataPriv.expando ] = undefined;
				}
				if ( elem[ dataUser.expando ] ) {

					// Support: Chrome <=35 - 45+
					// Assign undefined instead of using delete, see Data#remove
					elem[ dataUser.expando ] = undefined;
				}
			}
		}
	}
} );

jQuery.fn.extend( {
	detach: function( selector ) {
		return remove( this, selector, true );
	},

	remove: function( selector ) {
		return remove( this, selector );
	},

	text: function( value ) {
		return access( this, function( value ) {
			return value === undefined ?
				jQuery.text( this ) :
				this.empty().each( function() {
					if ( this.nodeType === 1 || this.nodeType === 11 || this.nodeType === 9 ) {
						this.textContent = value;
					}
				} );
		}, null, value, arguments.length );
	},

	append: function() {
		return domManip( this, arguments, function( elem ) {
			if ( this.nodeType === 1 || this.nodeType === 11 || this.nodeType === 9 ) {
				var target = manipulationTarget( this, elem );
				target.appendChild( elem );
			}
		} );
	},

	prepend: function() {
		return domManip( this, arguments, function( elem ) {
			if ( this.nodeType === 1 || this.nodeType === 11 || this.nodeType === 9 ) {
				var target = manipulationTarget( this, elem );
				target.insertBefore( elem, target.firstChild );
			}
		} );
	},

	before: function() {
		return domManip( this, arguments, function( elem ) {
			if ( this.parentNode ) {
				this.parentNode.insertBefore( elem, this );
			}
		} );
	},

	after: function() {
		return domManip( this, arguments, function( elem ) {
			if ( this.parentNode ) {
				this.parentNode.insertBefore( elem, this.nextSibling );
			}
		} );
	},

	empty: function() {
		var elem,
			i = 0;

		for ( ; ( elem = this[ i ] ) != null; i++ ) {
			if ( elem.nodeType === 1 ) {

				// Prevent memory leaks
				jQuery.cleanData( getAll( elem, false ) );

				// Remove any remaining nodes
				elem.textContent = "";
			}
		}

		return this;
	},

	clone: function( dataAndEvents, deepDataAndEvents ) {
		dataAndEvents = dataAndEvents == null ? false : dataAndEvents;
		deepDataAndEvents = deepDataAndEvents == null ? dataAndEvents : deepDataAndEvents;

		return this.map( function() {
			return jQuery.clone( this, dataAndEvents, deepDataAndEvents );
		} );
	},

	html: function( value ) {
		return access( this, function( value ) {
			var elem = this[ 0 ] || {},
				i = 0,
				l = this.length;

			if ( value === undefined && elem.nodeType === 1 ) {
				return elem.innerHTML;
			}

			// See if we can take a shortcut and just use innerHTML
			if ( typeof value === "string" && !rnoInnerhtml.test( value ) &&
				!wrapMap[ ( rtagName.exec( value ) || [ "", "" ] )[ 1 ].toLowerCase() ] ) {

				value = jQuery.htmlPrefilter( value );

				try {
					for ( ; i < l; i++ ) {
						elem = this[ i ] || {};

						// Remove element nodes and prevent memory leaks
						if ( elem.nodeType === 1 ) {
							jQuery.cleanData( getAll( elem, false ) );
							elem.innerHTML = value;
						}
					}

					elem = 0;

				// If using innerHTML throws an exception, use the fallback method
				} catch ( e ) {}
			}

			if ( elem ) {
				this.empty().append( value );
			}
		}, null, value, arguments.length );
	},

	replaceWith: function() {
		var ignored = [];

		// Make the changes, replacing each non-ignored context element with the new content
		return domManip( this, arguments, function( elem ) {
			var parent = this.parentNode;

			if ( jQuery.inArray( this, ignored ) < 0 ) {
				jQuery.cleanData( getAll( this ) );
				if ( parent ) {
					parent.replaceChild( elem, this );
				}
			}

		// Force callback invocation
		}, ignored );
	}
} );

jQuery.each( {
	appendTo: "append",
	prependTo: "prepend",
	insertBefore: "before",
	insertAfter: "after",
	replaceAll: "replaceWith"
}, function( name, original ) {
	jQuery.fn[ name ] = function( selector ) {
		var elems,
			ret = [],
			insert = jQuery( selector ),
			last = insert.length - 1,
			i = 0;

		for ( ; i <= last; i++ ) {
			elems = i === last ? this : this.clone( true );
			jQuery( insert[ i ] )[ original ]( elems );

			// Support: Android <=4.0 only, PhantomJS 1 only
			// .get() because push.apply(_, arraylike) throws on ancient WebKit
			push.apply( ret, elems.get() );
		}

		return this.pushStack( ret );
	};
} );
var rmargin = ( /^margin/ );

var rnumnonpx = new RegExp( "^(" + pnum + ")(?!px)[a-z%]+$", "i" );

var getStyles = function( elem ) {

		// Support: IE <=11 only, Firefox <=30 (#15098, #14150)
		// IE throws on elements created in popups
		// FF meanwhile throws on frame elements through "defaultView.getComputedStyle"
		var view = elem.ownerDocument.defaultView;

		if ( !view || !view.opener ) {
			view = window;
		}

		return view.getComputedStyle( elem );
	};



( function() {

	// Executing both pixelPosition & boxSizingReliable tests require only one layout
	// so they're executed at the same time to save the second computation.
	function computeStyleTests() {

		// This is a singleton, we need to execute it only once
		if ( !div ) {
			return;
		}

		div.style.cssText =
			"box-sizing:border-box;" +
			"position:relative;display:block;" +
			"margin:auto;border:1px;padding:1px;" +
			"top:1%;width:50%";
		div.innerHTML = "";
		documentElement.appendChild( container );

		var divStyle = window.getComputedStyle( div );
		pixelPositionVal = divStyle.top !== "1%";

		// Support: Android 4.0 - 4.3 only, Firefox <=3 - 44
		reliableMarginLeftVal = divStyle.marginLeft === "2px";
		boxSizingReliableVal = divStyle.width === "4px";

		// Support: Android 4.0 - 4.3 only
		// Some styles come back with percentage values, even though they shouldn't
		div.style.marginRight = "50%";
		pixelMarginRightVal = divStyle.marginRight === "4px";

		documentElement.removeChild( container );

		// Nullify the div so it wouldn't be stored in the memory and
		// it will also be a sign that checks already performed
		div = null;
	}

	var pixelPositionVal, boxSizingReliableVal, pixelMarginRightVal, reliableMarginLeftVal,
		container = document.createElement( "div" ),
		div = document.createElement( "div" );

	// Finish early in limited (non-browser) environments
	if ( !div.style ) {
		return;
	}

	// Support: IE <=9 - 11 only
	// Style of cloned element affects source element cloned (#8908)
	div.style.backgroundClip = "content-box";
	div.cloneNode( true ).style.backgroundClip = "";
	support.clearCloneStyle = div.style.backgroundClip === "content-box";

	container.style.cssText = "border:0;width:8px;height:0;top:0;left:-9999px;" +
		"padding:0;margin-top:1px;position:absolute";
	container.appendChild( div );

	jQuery.extend( support, {
		pixelPosition: function() {
			computeStyleTests();
			return pixelPositionVal;
		},
		boxSizingReliable: function() {
			computeStyleTests();
			return boxSizingReliableVal;
		},
		pixelMarginRight: function() {
			computeStyleTests();
			return pixelMarginRightVal;
		},
		reliableMarginLeft: function() {
			computeStyleTests();
			return reliableMarginLeftVal;
		}
	} );
} )();


function curCSS( elem, name, computed ) {
	var width, minWidth, maxWidth, ret,
		style = elem.style;

	computed = computed || getStyles( elem );

	// Support: IE <=9 only
	// getPropertyValue is only needed for .css('filter') (#12537)
	if ( computed ) {
		ret = computed.getPropertyValue( name ) || computed[ name ];

		if ( ret === "" && !jQuery.contains( elem.ownerDocument, elem ) ) {
			ret = jQuery.style( elem, name );
		}

		// A tribute to the "awesome hack by Dean Edwards"
		// Android Browser returns percentage for some values,
		// but width seems to be reliably pixels.
		// This is against the CSSOM draft spec:
		// https://drafts.csswg.org/cssom/#resolved-values
		if ( !support.pixelMarginRight() && rnumnonpx.test( ret ) && rmargin.test( name ) ) {

			// Remember the original values
			width = style.width;
			minWidth = style.minWidth;
			maxWidth = style.maxWidth;

			// Put in the new values to get a computed value out
			style.minWidth = style.maxWidth = style.width = ret;
			ret = computed.width;

			// Revert the changed values
			style.width = width;
			style.minWidth = minWidth;
			style.maxWidth = maxWidth;
		}
	}

	return ret !== undefined ?

		// Support: IE <=9 - 11 only
		// IE returns zIndex value as an integer.
		ret + "" :
		ret;
}


function addGetHookIf( conditionFn, hookFn ) {

	// Define the hook, we'll check on the first run if it's really needed.
	return {
		get: function() {
			if ( conditionFn() ) {

				// Hook not needed (or it's not possible to use it due
				// to missing dependency), remove it.
				delete this.get;
				return;
			}

			// Hook needed; redefine it so that the support test is not executed again.
			return ( this.get = hookFn ).apply( this, arguments );
		}
	};
}


var

	// Swappable if display is none or starts with table
	// except "table", "table-cell", or "table-caption"
	// See here for display values: https://developer.mozilla.org/en-US/docs/CSS/display
	rdisplayswap = /^(none|table(?!-c[ea]).+)/,
	cssShow = { position: "absolute", visibility: "hidden", display: "block" },
	cssNormalTransform = {
		letterSpacing: "0",
		fontWeight: "400"
	},

	cssPrefixes = [ "Webkit", "Moz", "ms" ],
	emptyStyle = document.createElement( "div" ).style;

// Return a css property mapped to a potentially vendor prefixed property
function vendorPropName( name ) {

	// Shortcut for names that are not vendor prefixed
	if ( name in emptyStyle ) {
		return name;
	}

	// Check for vendor prefixed names
	var capName = name[ 0 ].toUpperCase() + name.slice( 1 ),
		i = cssPrefixes.length;

	while ( i-- ) {
		name = cssPrefixes[ i ] + capName;
		if ( name in emptyStyle ) {
			return name;
		}
	}
}

function setPositiveNumber( elem, value, subtract ) {

	// Any relative (+/-) values have already been
	// normalized at this point
	var matches = rcssNum.exec( value );
	return matches ?

		// Guard against undefined "subtract", e.g., when used as in cssHooks
		Math.max( 0, matches[ 2 ] - ( subtract || 0 ) ) + ( matches[ 3 ] || "px" ) :
		value;
}

function augmentWidthOrHeight( elem, name, extra, isBorderBox, styles ) {
	var i,
		val = 0;

	// If we already have the right measurement, avoid augmentation
	if ( extra === ( isBorderBox ? "border" : "content" ) ) {
		i = 4;

	// Otherwise initialize for horizontal or vertical properties
	} else {
		i = name === "width" ? 1 : 0;
	}

	for ( ; i < 4; i += 2 ) {

		// Both box models exclude margin, so add it if we want it
		if ( extra === "margin" ) {
			val += jQuery.css( elem, extra + cssExpand[ i ], true, styles );
		}

		if ( isBorderBox ) {

			// border-box includes padding, so remove it if we want content
			if ( extra === "content" ) {
				val -= jQuery.css( elem, "padding" + cssExpand[ i ], true, styles );
			}

			// At this point, extra isn't border nor margin, so remove border
			if ( extra !== "margin" ) {
				val -= jQuery.css( elem, "border" + cssExpand[ i ] + "Width", true, styles );
			}
		} else {

			// At this point, extra isn't content, so add padding
			val += jQuery.css( elem, "padding" + cssExpand[ i ], true, styles );

			// At this point, extra isn't content nor padding, so add border
			if ( extra !== "padding" ) {
				val += jQuery.css( elem, "border" + cssExpand[ i ] + "Width", true, styles );
			}
		}
	}

	return val;
}

function getWidthOrHeight( elem, name, extra ) {

	// Start with offset property, which is equivalent to the border-box value
	var val,
		valueIsBorderBox = true,
		styles = getStyles( elem ),
		isBorderBox = jQuery.css( elem, "boxSizing", false, styles ) === "border-box";

	// Support: IE <=11 only
	// Running getBoundingClientRect on a disconnected node
	// in IE throws an error.
	if ( elem.getClientRects().length ) {
		val = elem.getBoundingClientRect()[ name ];
	}

	// Some non-html elements return undefined for offsetWidth, so check for null/undefined
	// svg - https://bugzilla.mozilla.org/show_bug.cgi?id=649285
	// MathML - https://bugzilla.mozilla.org/show_bug.cgi?id=491668
	if ( val <= 0 || val == null ) {

		// Fall back to computed then uncomputed css if necessary
		val = curCSS( elem, name, styles );
		if ( val < 0 || val == null ) {
			val = elem.style[ name ];
		}

		// Computed unit is not pixels. Stop here and return.
		if ( rnumnonpx.test( val ) ) {
			return val;
		}

		// Check for style in case a browser which returns unreliable values
		// for getComputedStyle silently falls back to the reliable elem.style
		valueIsBorderBox = isBorderBox &&
			( support.boxSizingReliable() || val === elem.style[ name ] );

		// Normalize "", auto, and prepare for extra
		val = parseFloat( val ) || 0;
	}

	// Use the active box-sizing model to add/subtract irrelevant styles
	return ( val +
		augmentWidthOrHeight(
			elem,
			name,
			extra || ( isBorderBox ? "border" : "content" ),
			valueIsBorderBox,
			styles
		)
	) + "px";
}

jQuery.extend( {

	// Add in style property hooks for overriding the default
	// behavior of getting and setting a style property
	cssHooks: {
		opacity: {
			get: function( elem, computed ) {
				if ( computed ) {

					// We should always get a number back from opacity
					var ret = curCSS( elem, "opacity" );
					return ret === "" ? "1" : ret;
				}
			}
		}
	},

	// Don't automatically add "px" to these possibly-unitless properties
	cssNumber: {
		"animationIterationCount": true,
		"columnCount": true,
		"fillOpacity": true,
		"flexGrow": true,
		"flexShrink": true,
		"fontWeight": true,
		"lineHeight": true,
		"opacity": true,
		"order": true,
		"orphans": true,
		"widows": true,
		"zIndex": true,
		"zoom": true
	},

	// Add in properties whose names you wish to fix before
	// setting or getting the value
	cssProps: {
		"float": "cssFloat"
	},

	// Get and set the style property on a DOM Node
	style: function( elem, name, value, extra ) {

		// Don't set styles on text and comment nodes
		if ( !elem || elem.nodeType === 3 || elem.nodeType === 8 || !elem.style ) {
			return;
		}

		// Make sure that we're working with the right name
		var ret, type, hooks,
			origName = jQuery.camelCase( name ),
			style = elem.style;

		name = jQuery.cssProps[ origName ] ||
			( jQuery.cssProps[ origName ] = vendorPropName( origName ) || origName );

		// Gets hook for the prefixed version, then unprefixed version
		hooks = jQuery.cssHooks[ name ] || jQuery.cssHooks[ origName ];

		// Check if we're setting a value
		if ( value !== undefined ) {
			type = typeof value;

			// Convert "+=" or "-=" to relative numbers (#7345)
			if ( type === "string" && ( ret = rcssNum.exec( value ) ) && ret[ 1 ] ) {
				value = adjustCSS( elem, name, ret );

				// Fixes bug #9237
				type = "number";
			}

			// Make sure that null and NaN values aren't set (#7116)
			if ( value == null || value !== value ) {
				return;
			}

			// If a number was passed in, add the unit (except for certain CSS properties)
			if ( type === "number" ) {
				value += ret && ret[ 3 ] || ( jQuery.cssNumber[ origName ] ? "" : "px" );
			}

			// background-* props affect original clone's values
			if ( !support.clearCloneStyle && value === "" && name.indexOf( "background" ) === 0 ) {
				style[ name ] = "inherit";
			}

			// If a hook was provided, use that value, otherwise just set the specified value
			if ( !hooks || !( "set" in hooks ) ||
				( value = hooks.set( elem, value, extra ) ) !== undefined ) {

				style[ name ] = value;
			}

		} else {

			// If a hook was provided get the non-computed value from there
			if ( hooks && "get" in hooks &&
				( ret = hooks.get( elem, false, extra ) ) !== undefined ) {

				return ret;
			}

			// Otherwise just get the value from the style object
			return style[ name ];
		}
	},

	css: function( elem, name, extra, styles ) {
		var val, num, hooks,
			origName = jQuery.camelCase( name );

		// Make sure that we're working with the right name
		name = jQuery.cssProps[ origName ] ||
			( jQuery.cssProps[ origName ] = vendorPropName( origName ) || origName );

		// Try prefixed name followed by the unprefixed name
		hooks = jQuery.cssHooks[ name ] || jQuery.cssHooks[ origName ];

		// If a hook was provided get the computed value from there
		if ( hooks && "get" in hooks ) {
			val = hooks.get( elem, true, extra );
		}

		// Otherwise, if a way to get the computed value exists, use that
		if ( val === undefined ) {
			val = curCSS( elem, name, styles );
		}

		// Convert "normal" to computed value
		if ( val === "normal" && name in cssNormalTransform ) {
			val = cssNormalTransform[ name ];
		}

		// Make numeric if forced or a qualifier was provided and val looks numeric
		if ( extra === "" || extra ) {
			num = parseFloat( val );
			return extra === true || isFinite( num ) ? num || 0 : val;
		}
		return val;
	}
} );

jQuery.each( [ "height", "width" ], function( i, name ) {
	jQuery.cssHooks[ name ] = {
		get: function( elem, computed, extra ) {
			if ( computed ) {

				// Certain elements can have dimension info if we invisibly show them
				// but it must have a current display style that would benefit
				return rdisplayswap.test( jQuery.css( elem, "display" ) ) &&

					// Support: Safari 8+
					// Table columns in Safari have non-zero offsetWidth & zero
					// getBoundingClientRect().width unless display is changed.
					// Support: IE <=11 only
					// Running getBoundingClientRect on a disconnected node
					// in IE throws an error.
					( !elem.getClientRects().length || !elem.getBoundingClientRect().width ) ?
						swap( elem, cssShow, function() {
							return getWidthOrHeight( elem, name, extra );
						} ) :
						getWidthOrHeight( elem, name, extra );
			}
		},

		set: function( elem, value, extra ) {
			var matches,
				styles = extra && getStyles( elem ),
				subtract = extra && augmentWidthOrHeight(
					elem,
					name,
					extra,
					jQuery.css( elem, "boxSizing", false, styles ) === "border-box",
					styles
				);

			// Convert to pixels if value adjustment is needed
			if ( subtract && ( matches = rcssNum.exec( value ) ) &&
				( matches[ 3 ] || "px" ) !== "px" ) {

				elem.style[ name ] = value;
				value = jQuery.css( elem, name );
			}

			return setPositiveNumber( elem, value, subtract );
		}
	};
} );

jQuery.cssHooks.marginLeft = addGetHookIf( support.reliableMarginLeft,
	function( elem, computed ) {
		if ( computed ) {
			return ( parseFloat( curCSS( elem, "marginLeft" ) ) ||
				elem.getBoundingClientRect().left -
					swap( elem, { marginLeft: 0 }, function() {
						return elem.getBoundingClientRect().left;
					} )
				) + "px";
		}
	}
);

// These hooks are used by animate to expand properties
jQuery.each( {
	margin: "",
	padding: "",
	border: "Width"
}, function( prefix, suffix ) {
	jQuery.cssHooks[ prefix + suffix ] = {
		expand: function( value ) {
			var i = 0,
				expanded = {},

				// Assumes a single number if not a string
				parts = typeof value === "string" ? value.split( " " ) : [ value ];

			for ( ; i < 4; i++ ) {
				expanded[ prefix + cssExpand[ i ] + suffix ] =
					parts[ i ] || parts[ i - 2 ] || parts[ 0 ];
			}

			return expanded;
		}
	};

	if ( !rmargin.test( prefix ) ) {
		jQuery.cssHooks[ prefix + suffix ].set = setPositiveNumber;
	}
} );

jQuery.fn.extend( {
	css: function( name, value ) {
		return access( this, function( elem, name, value ) {
			var styles, len,
				map = {},
				i = 0;

			if ( jQuery.isArray( name ) ) {
				styles = getStyles( elem );
				len = name.length;

				for ( ; i < len; i++ ) {
					map[ name[ i ] ] = jQuery.css( elem, name[ i ], false, styles );
				}

				return map;
			}

			return value !== undefined ?
				jQuery.style( elem, name, value ) :
				jQuery.css( elem, name );
		}, name, value, arguments.length > 1 );
	}
} );


function Tween( elem, options, prop, end, easing ) {
	return new Tween.prototype.init( elem, options, prop, end, easing );
}
jQuery.Tween = Tween;

Tween.prototype = {
	constructor: Tween,
	init: function( elem, options, prop, end, easing, unit ) {
		this.elem = elem;
		this.prop = prop;
		this.easing = easing || jQuery.easing._default;
		this.options = options;
		this.start = this.now = this.cur();
		this.end = end;
		this.unit = unit || ( jQuery.cssNumber[ prop ] ? "" : "px" );
	},
	cur: function() {
		var hooks = Tween.propHooks[ this.prop ];

		return hooks && hooks.get ?
			hooks.get( this ) :
			Tween.propHooks._default.get( this );
	},
	run: function( percent ) {
		var eased,
			hooks = Tween.propHooks[ this.prop ];

		if ( this.options.duration ) {
			this.pos = eased = jQuery.easing[ this.easing ](
				percent, this.options.duration * percent, 0, 1, this.options.duration
			);
		} else {
			this.pos = eased = percent;
		}
		this.now = ( this.end - this.start ) * eased + this.start;

		if ( this.options.step ) {
			this.options.step.call( this.elem, this.now, this );
		}

		if ( hooks && hooks.set ) {
			hooks.set( this );
		} else {
			Tween.propHooks._default.set( this );
		}
		return this;
	}
};

Tween.prototype.init.prototype = Tween.prototype;

Tween.propHooks = {
	_default: {
		get: function( tween ) {
			var result;

			// Use a property on the element directly when it is not a DOM element,
			// or when there is no matching style property that exists.
			if ( tween.elem.nodeType !== 1 ||
				tween.elem[ tween.prop ] != null && tween.elem.style[ tween.prop ] == null ) {
				return tween.elem[ tween.prop ];
			}

			// Passing an empty string as a 3rd parameter to .css will automatically
			// attempt a parseFloat and fallback to a string if the parse fails.
			// Simple values such as "10px" are parsed to Float;
			// complex values such as "rotate(1rad)" are returned as-is.
			result = jQuery.css( tween.elem, tween.prop, "" );

			// Empty strings, null, undefined and "auto" are converted to 0.
			return !result || result === "auto" ? 0 : result;
		},
		set: function( tween ) {

			// Use step hook for back compat.
			// Use cssHook if its there.
			// Use .style if available and use plain properties where available.
			if ( jQuery.fx.step[ tween.prop ] ) {
				jQuery.fx.step[ tween.prop ]( tween );
			} else if ( tween.elem.nodeType === 1 &&
				( tween.elem.style[ jQuery.cssProps[ tween.prop ] ] != null ||
					jQuery.cssHooks[ tween.prop ] ) ) {
				jQuery.style( tween.elem, tween.prop, tween.now + tween.unit );
			} else {
				tween.elem[ tween.prop ] = tween.now;
			}
		}
	}
};

// Support: IE <=9 only
// Panic based approach to setting things on disconnected nodes
Tween.propHooks.scrollTop = Tween.propHooks.scrollLeft = {
	set: function( tween ) {
		if ( tween.elem.nodeType && tween.elem.parentNode ) {
			tween.elem[ tween.prop ] = tween.now;
		}
	}
};

jQuery.easing = {
	linear: function( p ) {
		return p;
	},
	swing: function( p ) {
		return 0.5 - Math.cos( p * Math.PI ) / 2;
	},
	_default: "swing"
};

jQuery.fx = Tween.prototype.init;

// Back compat <1.8 extension point
jQuery.fx.step = {};




var
	fxNow, timerId,
	rfxtypes = /^(?:toggle|show|hide)$/,
	rrun = /queueHooks$/;

function raf() {
	if ( timerId ) {
		window.requestAnimationFrame( raf );
		jQuery.fx.tick();
	}
}

// Animations created synchronously will run synchronously
function createFxNow() {
	window.setTimeout( function() {
		fxNow = undefined;
	} );
	return ( fxNow = jQuery.now() );
}

// Generate parameters to create a standard animation
function genFx( type, includeWidth ) {
	var which,
		i = 0,
		attrs = { height: type };

	// If we include width, step value is 1 to do all cssExpand values,
	// otherwise step value is 2 to skip over Left and Right
	includeWidth = includeWidth ? 1 : 0;
	for ( ; i < 4; i += 2 - includeWidth ) {
		which = cssExpand[ i ];
		attrs[ "margin" + which ] = attrs[ "padding" + which ] = type;
	}

	if ( includeWidth ) {
		attrs.opacity = attrs.width = type;
	}

	return attrs;
}

function createTween( value, prop, animation ) {
	var tween,
		collection = ( Animation.tweeners[ prop ] || [] ).concat( Animation.tweeners[ "*" ] ),
		index = 0,
		length = collection.length;
	for ( ; index < length; index++ ) {
		if ( ( tween = collection[ index ].call( animation, prop, value ) ) ) {

			// We're done with this property
			return tween;
		}
	}
}

function defaultPrefilter( elem, props, opts ) {
	var prop, value, toggle, hooks, oldfire, propTween, restoreDisplay, display,
		isBox = "width" in props || "height" in props,
		anim = this,
		orig = {},
		style = elem.style,
		hidden = elem.nodeType && isHiddenWithinTree( elem ),
		dataShow = dataPriv.get( elem, "fxshow" );

	// Queue-skipping animations hijack the fx hooks
	if ( !opts.queue ) {
		hooks = jQuery._queueHooks( elem, "fx" );
		if ( hooks.unqueued == null ) {
			hooks.unqueued = 0;
			oldfire = hooks.empty.fire;
			hooks.empty.fire = function() {
				if ( !hooks.unqueued ) {
					oldfire();
				}
			};
		}
		hooks.unqueued++;

		anim.always( function() {

			// Ensure the complete handler is called before this completes
			anim.always( function() {
				hooks.unqueued--;
				if ( !jQuery.queue( elem, "fx" ).length ) {
					hooks.empty.fire();
				}
			} );
		} );
	}

	// Detect show/hide animations
	for ( prop in props ) {
		value = props[ prop ];
		if ( rfxtypes.test( value ) ) {
			delete props[ prop ];
			toggle = toggle || value === "toggle";
			if ( value === ( hidden ? "hide" : "show" ) ) {

				// Pretend to be hidden if this is a "show" and
				// there is still data from a stopped show/hide
				if ( value === "show" && dataShow && dataShow[ prop ] !== undefined ) {
					hidden = true;

				// Ignore all other no-op show/hide data
				} else {
					continue;
				}
			}
			orig[ prop ] = dataShow && dataShow[ prop ] || jQuery.style( elem, prop );
		}
	}

	// Bail out if this is a no-op like .hide().hide()
	propTween = !jQuery.isEmptyObject( props );
	if ( !propTween && jQuery.isEmptyObject( orig ) ) {
		return;
	}

	// Restrict "overflow" and "display" styles during box animations
	if ( isBox && elem.nodeType === 1 ) {

		// Support: IE <=9 - 11, Edge 12 - 13
		// Record all 3 overflow attributes because IE does not infer the shorthand
		// from identically-valued overflowX and overflowY
		opts.overflow = [ style.overflow, style.overflowX, style.overflowY ];

		// Identify a display type, preferring old show/hide data over the CSS cascade
		restoreDisplay = dataShow && dataShow.display;
		if ( restoreDisplay == null ) {
			restoreDisplay = dataPriv.get( elem, "display" );
		}
		display = jQuery.css( elem, "display" );
		if ( display === "none" ) {
			if ( restoreDisplay ) {
				display = restoreDisplay;
			} else {

				// Get nonempty value(s) by temporarily forcing visibility
				showHide( [ elem ], true );
				restoreDisplay = elem.style.display || restoreDisplay;
				display = jQuery.css( elem, "display" );
				showHide( [ elem ] );
			}
		}

		// Animate inline elements as inline-block
		if ( display === "inline" || display === "inline-block" && restoreDisplay != null ) {
			if ( jQuery.css( elem, "float" ) === "none" ) {

				// Restore the original display value at the end of pure show/hide animations
				if ( !propTween ) {
					anim.done( function() {
						style.display = restoreDisplay;
					} );
					if ( restoreDisplay == null ) {
						display = style.display;
						restoreDisplay = display === "none" ? "" : display;
					}
				}
				style.display = "inline-block";
			}
		}
	}

	if ( opts.overflow ) {
		style.overflow = "hidden";
		anim.always( function() {
			style.overflow = opts.overflow[ 0 ];
			style.overflowX = opts.overflow[ 1 ];
			style.overflowY = opts.overflow[ 2 ];
		} );
	}

	// Implement show/hide animations
	propTween = false;
	for ( prop in orig ) {

		// General show/hide setup for this element animation
		if ( !propTween ) {
			if ( dataShow ) {
				if ( "hidden" in dataShow ) {
					hidden = dataShow.hidden;
				}
			} else {
				dataShow = dataPriv.access( elem, "fxshow", { display: restoreDisplay } );
			}

			// Store hidden/visible for toggle so `.stop().toggle()` "reverses"
			if ( toggle ) {
				dataShow.hidden = !hidden;
			}

			// Show elements before animating them
			if ( hidden ) {
				showHide( [ elem ], true );
			}

			/* eslint-disable no-loop-func */

			anim.done( function() {

			/* eslint-enable no-loop-func */

				// The final step of a "hide" animation is actually hiding the element
				if ( !hidden ) {
					showHide( [ elem ] );
				}
				dataPriv.remove( elem, "fxshow" );
				for ( prop in orig ) {
					jQuery.style( elem, prop, orig[ prop ] );
				}
			} );
		}

		// Per-property setup
		propTween = createTween( hidden ? dataShow[ prop ] : 0, prop, anim );
		if ( !( prop in dataShow ) ) {
			dataShow[ prop ] = propTween.start;
			if ( hidden ) {
				propTween.end = propTween.start;
				propTween.start = 0;
			}
		}
	}
}

function propFilter( props, specialEasing ) {
	var index, name, easing, value, hooks;

	// camelCase, specialEasing and expand cssHook pass
	for ( index in props ) {
		name = jQuery.camelCase( index );
		easing = specialEasing[ name ];
		value = props[ index ];
		if ( jQuery.isArray( value ) ) {
			easing = value[ 1 ];
			value = props[ index ] = value[ 0 ];
		}

		if ( index !== name ) {
			props[ name ] = value;
			delete props[ index ];
		}

		hooks = jQuery.cssHooks[ name ];
		if ( hooks && "expand" in hooks ) {
			value = hooks.expand( value );
			delete props[ name ];

			// Not quite $.extend, this won't overwrite existing keys.
			// Reusing 'index' because we have the correct "name"
			for ( index in value ) {
				if ( !( index in props ) ) {
					props[ index ] = value[ index ];
					specialEasing[ index ] = easing;
				}
			}
		} else {
			specialEasing[ name ] = easing;
		}
	}
}

function Animation( elem, properties, options ) {
	var result,
		stopped,
		index = 0,
		length = Animation.prefilters.length,
		deferred = jQuery.Deferred().always( function() {

			// Don't match elem in the :animated selector
			delete tick.elem;
		} ),
		tick = function() {
			if ( stopped ) {
				return false;
			}
			var currentTime = fxNow || createFxNow(),
				remaining = Math.max( 0, animation.startTime + animation.duration - currentTime ),

				// Support: Android 2.3 only
				// Archaic crash bug won't allow us to use `1 - ( 0.5 || 0 )` (#12497)
				temp = remaining / animation.duration || 0,
				percent = 1 - temp,
				index = 0,
				length = animation.tweens.length;

			for ( ; index < length; index++ ) {
				animation.tweens[ index ].run( percent );
			}

			deferred.notifyWith( elem, [ animation, percent, remaining ] );

			if ( percent < 1 && length ) {
				return remaining;
			} else {
				deferred.resolveWith( elem, [ animation ] );
				return false;
			}
		},
		animation = deferred.promise( {
			elem: elem,
			props: jQuery.extend( {}, properties ),
			opts: jQuery.extend( true, {
				specialEasing: {},
				easing: jQuery.easing._default
			}, options ),
			originalProperties: properties,
			originalOptions: options,
			startTime: fxNow || createFxNow(),
			duration: options.duration,
			tweens: [],
			createTween: function( prop, end ) {
				var tween = jQuery.Tween( elem, animation.opts, prop, end,
						animation.opts.specialEasing[ prop ] || animation.opts.easing );
				animation.tweens.push( tween );
				return tween;
			},
			stop: function( gotoEnd ) {
				var index = 0,

					// If we are going to the end, we want to run all the tweens
					// otherwise we skip this part
					length = gotoEnd ? animation.tweens.length : 0;
				if ( stopped ) {
					return this;
				}
				stopped = true;
				for ( ; index < length; index++ ) {
					animation.tweens[ index ].run( 1 );
				}

				// Resolve when we played the last frame; otherwise, reject
				if ( gotoEnd ) {
					deferred.notifyWith( elem, [ animation, 1, 0 ] );
					deferred.resolveWith( elem, [ animation, gotoEnd ] );
				} else {
					deferred.rejectWith( elem, [ animation, gotoEnd ] );
				}
				return this;
			}
		} ),
		props = animation.props;

	propFilter( props, animation.opts.specialEasing );

	for ( ; index < length; index++ ) {
		result = Animation.prefilters[ index ].call( animation, elem, props, animation.opts );
		if ( result ) {
			if ( jQuery.isFunction( result.stop ) ) {
				jQuery._queueHooks( animation.elem, animation.opts.queue ).stop =
					jQuery.proxy( result.stop, result );
			}
			return result;
		}
	}

	jQuery.map( props, createTween, animation );

	if ( jQuery.isFunction( animation.opts.start ) ) {
		animation.opts.start.call( elem, animation );
	}

	jQuery.fx.timer(
		jQuery.extend( tick, {
			elem: elem,
			anim: animation,
			queue: animation.opts.queue
		} )
	);

	// attach callbacks from options
	return animation.progress( animation.opts.progress )
		.done( animation.opts.done, animation.opts.complete )
		.fail( animation.opts.fail )
		.always( animation.opts.always );
}

jQuery.Animation = jQuery.extend( Animation, {

	tweeners: {
		"*": [ function( prop, value ) {
			var tween = this.createTween( prop, value );
			adjustCSS( tween.elem, prop, rcssNum.exec( value ), tween );
			return tween;
		} ]
	},

	tweener: function( props, callback ) {
		if ( jQuery.isFunction( props ) ) {
			callback = props;
			props = [ "*" ];
		} else {
			props = props.match( rnothtmlwhite );
		}

		var prop,
			index = 0,
			length = props.length;

		for ( ; index < length; index++ ) {
			prop = props[ index ];
			Animation.tweeners[ prop ] = Animation.tweeners[ prop ] || [];
			Animation.tweeners[ prop ].unshift( callback );
		}
	},

	prefilters: [ defaultPrefilter ],

	prefilter: function( callback, prepend ) {
		if ( prepend ) {
			Animation.prefilters.unshift( callback );
		} else {
			Animation.prefilters.push( callback );
		}
	}
} );

jQuery.speed = function( speed, easing, fn ) {
	var opt = speed && typeof speed === "object" ? jQuery.extend( {}, speed ) : {
		complete: fn || !fn && easing ||
			jQuery.isFunction( speed ) && speed,
		duration: speed,
		easing: fn && easing || easing && !jQuery.isFunction( easing ) && easing
	};

	// Go to the end state if fx are off or if document is hidden
	if ( jQuery.fx.off || document.hidden ) {
		opt.duration = 0;

	} else {
		if ( typeof opt.duration !== "number" ) {
			if ( opt.duration in jQuery.fx.speeds ) {
				opt.duration = jQuery.fx.speeds[ opt.duration ];

			} else {
				opt.duration = jQuery.fx.speeds._default;
			}
		}
	}

	// Normalize opt.queue - true/undefined/null -> "fx"
	if ( opt.queue == null || opt.queue === true ) {
		opt.queue = "fx";
	}

	// Queueing
	opt.old = opt.complete;

	opt.complete = function() {
		if ( jQuery.isFunction( opt.old ) ) {
			opt.old.call( this );
		}

		if ( opt.queue ) {
			jQuery.dequeue( this, opt.queue );
		}
	};

	return opt;
};

jQuery.fn.extend( {
	fadeTo: function( speed, to, easing, callback ) {

		// Show any hidden elements after setting opacity to 0
		return this.filter( isHiddenWithinTree ).css( "opacity", 0 ).show()

			// Animate to the value specified
			.end().animate( { opacity: to }, speed, easing, callback );
	},
	animate: function( prop, speed, easing, callback ) {
		var empty = jQuery.isEmptyObject( prop ),
			optall = jQuery.speed( speed, easing, callback ),
			doAnimation = function() {

				// Operate on a copy of prop so per-property easing won't be lost
				var anim = Animation( this, jQuery.extend( {}, prop ), optall );

				// Empty animations, or finishing resolves immediately
				if ( empty || dataPriv.get( this, "finish" ) ) {
					anim.stop( true );
				}
			};
			doAnimation.finish = doAnimation;

		return empty || optall.queue === false ?
			this.each( doAnimation ) :
			this.queue( optall.queue, doAnimation );
	},
	stop: function( type, clearQueue, gotoEnd ) {
		var stopQueue = function( hooks ) {
			var stop = hooks.stop;
			delete hooks.stop;
			stop( gotoEnd );
		};

		if ( typeof type !== "string" ) {
			gotoEnd = clearQueue;
			clearQueue = type;
			type = undefined;
		}
		if ( clearQueue && type !== false ) {
			this.queue( type || "fx", [] );
		}

		return this.each( function() {
			var dequeue = true,
				index = type != null && type + "queueHooks",
				timers = jQuery.timers,
				data = dataPriv.get( this );

			if ( index ) {
				if ( data[ index ] && data[ index ].stop ) {
					stopQueue( data[ index ] );
				}
			} else {
				for ( index in data ) {
					if ( data[ index ] && data[ index ].stop && rrun.test( index ) ) {
						stopQueue( data[ index ] );
					}
				}
			}

			for ( index = timers.length; index--; ) {
				if ( timers[ index ].elem === this &&
					( type == null || timers[ index ].queue === type ) ) {

					timers[ index ].anim.stop( gotoEnd );
					dequeue = false;
					timers.splice( index, 1 );
				}
			}

			// Start the next in the queue if the last step wasn't forced.
			// Timers currently will call their complete callbacks, which
			// will dequeue but only if they were gotoEnd.
			if ( dequeue || !gotoEnd ) {
				jQuery.dequeue( this, type );
			}
		} );
	},
	finish: function( type ) {
		if ( type !== false ) {
			type = type || "fx";
		}
		return this.each( function() {
			var index,
				data = dataPriv.get( this ),
				queue = data[ type + "queue" ],
				hooks = data[ type + "queueHooks" ],
				timers = jQuery.timers,
				length = queue ? queue.length : 0;

			// Enable finishing flag on private data
			data.finish = true;

			// Empty the queue first
			jQuery.queue( this, type, [] );

			if ( hooks && hooks.stop ) {
				hooks.stop.call( this, true );
			}

			// Look for any active animations, and finish them
			for ( index = timers.length; index--; ) {
				if ( timers[ index ].elem === this && timers[ index ].queue === type ) {
					timers[ index ].anim.stop( true );
					timers.splice( index, 1 );
				}
			}

			// Look for any animations in the old queue and finish them
			for ( index = 0; index < length; index++ ) {
				if ( queue[ index ] && queue[ index ].finish ) {
					queue[ index ].finish.call( this );
				}
			}

			// Turn off finishing flag
			delete data.finish;
		} );
	}
} );

jQuery.each( [ "toggle", "show", "hide" ], function( i, name ) {
	var cssFn = jQuery.fn[ name ];
	jQuery.fn[ name ] = function( speed, easing, callback ) {
		return speed == null || typeof speed === "boolean" ?
			cssFn.apply( this, arguments ) :
			this.animate( genFx( name, true ), speed, easing, callback );
	};
} );

// Generate shortcuts for custom animations
jQuery.each( {
	slideDown: genFx( "show" ),
	slideUp: genFx( "hide" ),
	slideToggle: genFx( "toggle" ),
	fadeIn: { opacity: "show" },
	fadeOut: { opacity: "hide" },
	fadeToggle: { opacity: "toggle" }
}, function( name, props ) {
	jQuery.fn[ name ] = function( speed, easing, callback ) {
		return this.animate( props, speed, easing, callback );
	};
} );

jQuery.timers = [];
jQuery.fx.tick = function() {
	var timer,
		i = 0,
		timers = jQuery.timers;

	fxNow = jQuery.now();

	for ( ; i < timers.length; i++ ) {
		timer = timers[ i ];

		// Checks the timer has not already been removed
		if ( !timer() && timers[ i ] === timer ) {
			timers.splice( i--, 1 );
		}
	}

	if ( !timers.length ) {
		jQuery.fx.stop();
	}
	fxNow = undefined;
};

jQuery.fx.timer = function( timer ) {
	jQuery.timers.push( timer );
	if ( timer() ) {
		jQuery.fx.start();
	} else {
		jQuery.timers.pop();
	}
};

jQuery.fx.interval = 13;
jQuery.fx.start = function() {
	if ( !timerId ) {
		timerId = window.requestAnimationFrame ?
			window.requestAnimationFrame( raf ) :
			window.setInterval( jQuery.fx.tick, jQuery.fx.interval );
	}
};

jQuery.fx.stop = function() {
	if ( window.cancelAnimationFrame ) {
		window.cancelAnimationFrame( timerId );
	} else {
		window.clearInterval( timerId );
	}

	timerId = null;
};

jQuery.fx.speeds = {
	slow: 600,
	fast: 200,

	// Default speed
	_default: 400
};


// Based off of the plugin by Clint Helfers, with permission.
// https://web.archive.org/web/20100324014747/http://blindsignals.com/index.php/2009/07/jquery-delay/
jQuery.fn.delay = function( time, type ) {
	time = jQuery.fx ? jQuery.fx.speeds[ time ] || time : time;
	type = type || "fx";

	return this.queue( type, function( next, hooks ) {
		var timeout = window.setTimeout( next, time );
		hooks.stop = function() {
			window.clearTimeout( timeout );
		};
	} );
};


( function() {
	var input = document.createElement( "input" ),
		select = document.createElement( "select" ),
		opt = select.appendChild( document.createElement( "option" ) );

	input.type = "checkbox";

	// Support: Android <=4.3 only
	// Default value for a checkbox should be "on"
	support.checkOn = input.value !== "";

	// Support: IE <=11 only
	// Must access selectedIndex to make default options select
	support.optSelected = opt.selected;

	// Support: IE <=11 only
	// An input loses its value after becoming a radio
	input = document.createElement( "input" );
	input.value = "t";
	input.type = "radio";
	support.radioValue = input.value === "t";
} )();


var boolHook,
	attrHandle = jQuery.expr.attrHandle;

jQuery.fn.extend( {
	attr: function( name, value ) {
		return access( this, jQuery.attr, name, value, arguments.length > 1 );
	},

	removeAttr: function( name ) {
		return this.each( function() {
			jQuery.removeAttr( this, name );
		} );
	}
} );

jQuery.extend( {
	attr: function( elem, name, value ) {
		var ret, hooks,
			nType = elem.nodeType;

		// Don't get/set attributes on text, comment and attribute nodes
		if ( nType === 3 || nType === 8 || nType === 2 ) {
			return;
		}

		// Fallback to prop when attributes are not supported
		if ( typeof elem.getAttribute === "undefined" ) {
			return jQuery.prop( elem, name, value );
		}

		// Attribute hooks are determined by the lowercase version
		// Grab necessary hook if one is defined
		if ( nType !== 1 || !jQuery.isXMLDoc( elem ) ) {
			hooks = jQuery.attrHooks[ name.toLowerCase() ] ||
				( jQuery.expr.match.bool.test( name ) ? boolHook : undefined );
		}

		if ( value !== undefined ) {
			if ( value === null ) {
				jQuery.removeAttr( elem, name );
				return;
			}

			if ( hooks && "set" in hooks &&
				( ret = hooks.set( elem, value, name ) ) !== undefined ) {
				return ret;
			}

			elem.setAttribute( name, value + "" );
			return value;
		}

		if ( hooks && "get" in hooks && ( ret = hooks.get( elem, name ) ) !== null ) {
			return ret;
		}

		ret = jQuery.find.attr( elem, name );

		// Non-existent attributes return null, we normalize to undefined
		return ret == null ? undefined : ret;
	},

	attrHooks: {
		type: {
			set: function( elem, value ) {
				if ( !support.radioValue && value === "radio" &&
					jQuery.nodeName( elem, "input" ) ) {
					var val = elem.value;
					elem.setAttribute( "type", value );
					if ( val ) {
						elem.value = val;
					}
					return value;
				}
			}
		}
	},

	removeAttr: function( elem, value ) {
		var name,
			i = 0,

			// Attribute names can contain non-HTML whitespace characters
			// https://html.spec.whatwg.org/multipage/syntax.html#attributes-2
			attrNames = value && value.match( rnothtmlwhite );

		if ( attrNames && elem.nodeType === 1 ) {
			while ( ( name = attrNames[ i++ ] ) ) {
				elem.removeAttribute( name );
			}
		}
	}
} );

// Hooks for boolean attributes
boolHook = {
	set: function( elem, value, name ) {
		if ( value === false ) {

			// Remove boolean attributes when set to false
			jQuery.removeAttr( elem, name );
		} else {
			elem.setAttribute( name, name );
		}
		return name;
	}
};

jQuery.each( jQuery.expr.match.bool.source.match( /\w+/g ), function( i, name ) {
	var getter = attrHandle[ name ] || jQuery.find.attr;

	attrHandle[ name ] = function( elem, name, isXML ) {
		var ret, handle,
			lowercaseName = name.toLowerCase();

		if ( !isXML ) {

			// Avoid an infinite loop by temporarily removing this function from the getter
			handle = attrHandle[ lowercaseName ];
			attrHandle[ lowercaseName ] = ret;
			ret = getter( elem, name, isXML ) != null ?
				lowercaseName :
				null;
			attrHandle[ lowercaseName ] = handle;
		}
		return ret;
	};
} );




var rfocusable = /^(?:input|select|textarea|button)$/i,
	rclickable = /^(?:a|area)$/i;

jQuery.fn.extend( {
	prop: function( name, value ) {
		return access( this, jQuery.prop, name, value, arguments.length > 1 );
	},

	removeProp: function( name ) {
		return this.each( function() {
			delete this[ jQuery.propFix[ name ] || name ];
		} );
	}
} );

jQuery.extend( {
	prop: function( elem, name, value ) {
		var ret, hooks,
			nType = elem.nodeType;

		// Don't get/set properties on text, comment and attribute nodes
		if ( nType === 3 || nType === 8 || nType === 2 ) {
			return;
		}

		if ( nType !== 1 || !jQuery.isXMLDoc( elem ) ) {

			// Fix name and attach hooks
			name = jQuery.propFix[ name ] || name;
			hooks = jQuery.propHooks[ name ];
		}

		if ( value !== undefined ) {
			if ( hooks && "set" in hooks &&
				( ret = hooks.set( elem, value, name ) ) !== undefined ) {
				return ret;
			}

			return ( elem[ name ] = value );
		}

		if ( hooks && "get" in hooks && ( ret = hooks.get( elem, name ) ) !== null ) {
			return ret;
		}

		return elem[ name ];
	},

	propHooks: {
		tabIndex: {
			get: function( elem ) {

				// Support: IE <=9 - 11 only
				// elem.tabIndex doesn't always return the
				// correct value when it hasn't been explicitly set
				// https://web.archive.org/web/20141116233347/http://fluidproject.org/blog/2008/01/09/getting-setting-and-removing-tabindex-values-with-javascript/
				// Use proper attribute retrieval(#12072)
				var tabindex = jQuery.find.attr( elem, "tabindex" );

				if ( tabindex ) {
					return parseInt( tabindex, 10 );
				}

				if (
					rfocusable.test( elem.nodeName ) ||
					rclickable.test( elem.nodeName ) &&
					elem.href
				) {
					return 0;
				}

				return -1;
			}
		}
	},

	propFix: {
		"for": "htmlFor",
		"class": "className"
	}
} );

// Support: IE <=11 only
// Accessing the selectedIndex property
// forces the browser to respect setting selected
// on the option
// The getter ensures a default option is selected
// when in an optgroup
// eslint rule "no-unused-expressions" is disabled for this code
// since it considers such accessions noop
if ( !support.optSelected ) {
	jQuery.propHooks.selected = {
		get: function( elem ) {

			/* eslint no-unused-expressions: "off" */

			var parent = elem.parentNode;
			if ( parent && parent.parentNode ) {
				parent.parentNode.selectedIndex;
			}
			return null;
		},
		set: function( elem ) {

			/* eslint no-unused-expressions: "off" */

			var parent = elem.parentNode;
			if ( parent ) {
				parent.selectedIndex;

				if ( parent.parentNode ) {
					parent.parentNode.selectedIndex;
				}
			}
		}
	};
}

jQuery.each( [
	"tabIndex",
	"readOnly",
	"maxLength",
	"cellSpacing",
	"cellPadding",
	"rowSpan",
	"colSpan",
	"useMap",
	"frameBorder",
	"contentEditable"
], function() {
	jQuery.propFix[ this.toLowerCase() ] = this;
} );




	// Strip and collapse whitespace according to HTML spec
	// https://html.spec.whatwg.org/multipage/infrastructure.html#strip-and-collapse-whitespace
	function stripAndCollapse( value ) {
		var tokens = value.match( rnothtmlwhite ) || [];
		return tokens.join( " " );
	}


function getClass( elem ) {
	return elem.getAttribute && elem.getAttribute( "class" ) || "";
}

jQuery.fn.extend( {
	addClass: function( value ) {
		var classes, elem, cur, curValue, clazz, j, finalValue,
			i = 0;

		if ( jQuery.isFunction( value ) ) {
			return this.each( function( j ) {
				jQuery( this ).addClass( value.call( this, j, getClass( this ) ) );
			} );
		}

		if ( typeof value === "string" && value ) {
			classes = value.match( rnothtmlwhite ) || [];

			while ( ( elem = this[ i++ ] ) ) {
				curValue = getClass( elem );
				cur = elem.nodeType === 1 && ( " " + stripAndCollapse( curValue ) + " " );

				if ( cur ) {
					j = 0;
					while ( ( clazz = classes[ j++ ] ) ) {
						if ( cur.indexOf( " " + clazz + " " ) < 0 ) {
							cur += clazz + " ";
						}
					}

					// Only assign if different to avoid unneeded rendering.
					finalValue = stripAndCollapse( cur );
					if ( curValue !== finalValue ) {
						elem.setAttribute( "class", finalValue );
					}
				}
			}
		}

		return this;
	},

	removeClass: function( value ) {
		var classes, elem, cur, curValue, clazz, j, finalValue,
			i = 0;

		if ( jQuery.isFunction( value ) ) {
			return this.each( function( j ) {
				jQuery( this ).removeClass( value.call( this, j, getClass( this ) ) );
			} );
		}

		if ( !arguments.length ) {
			return this.attr( "class", "" );
		}

		if ( typeof value === "string" && value ) {
			classes = value.match( rnothtmlwhite ) || [];

			while ( ( elem = this[ i++ ] ) ) {
				curValue = getClass( elem );

				// This expression is here for better compressibility (see addClass)
				cur = elem.nodeType === 1 && ( " " + stripAndCollapse( curValue ) + " " );

				if ( cur ) {
					j = 0;
					while ( ( clazz = classes[ j++ ] ) ) {

						// Remove *all* instances
						while ( cur.indexOf( " " + clazz + " " ) > -1 ) {
							cur = cur.replace( " " + clazz + " ", " " );
						}
					}

					// Only assign if different to avoid unneeded rendering.
					finalValue = stripAndCollapse( cur );
					if ( curValue !== finalValue ) {
						elem.setAttribute( "class", finalValue );
					}
				}
			}
		}

		return this;
	},

	toggleClass: function( value, stateVal ) {
		var type = typeof value;

		if ( typeof stateVal === "boolean" && type === "string" ) {
			return stateVal ? this.addClass( value ) : this.removeClass( value );
		}

		if ( jQuery.isFunction( value ) ) {
			return this.each( function( i ) {
				jQuery( this ).toggleClass(
					value.call( this, i, getClass( this ), stateVal ),
					stateVal
				);
			} );
		}

		return this.each( function() {
			var className, i, self, classNames;

			if ( type === "string" ) {

				// Toggle individual class names
				i = 0;
				self = jQuery( this );
				classNames = value.match( rnothtmlwhite ) || [];

				while ( ( className = classNames[ i++ ] ) ) {

					// Check each className given, space separated list
					if ( self.hasClass( className ) ) {
						self.removeClass( className );
					} else {
						self.addClass( className );
					}
				}

			// Toggle whole class name
			} else if ( value === undefined || type === "boolean" ) {
				className = getClass( this );
				if ( className ) {

					// Store className if set
					dataPriv.set( this, "__className__", className );
				}

				// If the element has a class name or if we're passed `false`,
				// then remove the whole classname (if there was one, the above saved it).
				// Otherwise bring back whatever was previously saved (if anything),
				// falling back to the empty string if nothing was stored.
				if ( this.setAttribute ) {
					this.setAttribute( "class",
						className || value === false ?
						"" :
						dataPriv.get( this, "__className__" ) || ""
					);
				}
			}
		} );
	},

	hasClass: function( selector ) {
		var className, elem,
			i = 0;

		className = " " + selector + " ";
		while ( ( elem = this[ i++ ] ) ) {
			if ( elem.nodeType === 1 &&
				( " " + stripAndCollapse( getClass( elem ) ) + " " ).indexOf( className ) > -1 ) {
					return true;
			}
		}

		return false;
	}
} );




var rreturn = /\r/g;

jQuery.fn.extend( {
	val: function( value ) {
		var hooks, ret, isFunction,
			elem = this[ 0 ];

		if ( !arguments.length ) {
			if ( elem ) {
				hooks = jQuery.valHooks[ elem.type ] ||
					jQuery.valHooks[ elem.nodeName.toLowerCase() ];

				if ( hooks &&
					"get" in hooks &&
					( ret = hooks.get( elem, "value" ) ) !== undefined
				) {
					return ret;
				}

				ret = elem.value;

				// Handle most common string cases
				if ( typeof ret === "string" ) {
					return ret.replace( rreturn, "" );
				}

				// Handle cases where value is null/undef or number
				return ret == null ? "" : ret;
			}

			return;
		}

		isFunction = jQuery.isFunction( value );

		return this.each( function( i ) {
			var val;

			if ( this.nodeType !== 1 ) {
				return;
			}

			if ( isFunction ) {
				val = value.call( this, i, jQuery( this ).val() );
			} else {
				val = value;
			}

			// Treat null/undefined as ""; convert numbers to string
			if ( val == null ) {
				val = "";

			} else if ( typeof val === "number" ) {
				val += "";

			} else if ( jQuery.isArray( val ) ) {
				val = jQuery.map( val, function( value ) {
					return value == null ? "" : value + "";
				} );
			}

			hooks = jQuery.valHooks[ this.type ] || jQuery.valHooks[ this.nodeName.toLowerCase() ];

			// If set returns undefined, fall back to normal setting
			if ( !hooks || !( "set" in hooks ) || hooks.set( this, val, "value" ) === undefined ) {
				this.value = val;
			}
		} );
	}
} );

jQuery.extend( {
	valHooks: {
		option: {
			get: function( elem ) {

				var val = jQuery.find.attr( elem, "value" );
				return val != null ?
					val :

					// Support: IE <=10 - 11 only
					// option.text throws exceptions (#14686, #14858)
					// Strip and collapse whitespace
					// https://html.spec.whatwg.org/#strip-and-collapse-whitespace
					stripAndCollapse( jQuery.text( elem ) );
			}
		},
		select: {
			get: function( elem ) {
				var value, option, i,
					options = elem.options,
					index = elem.selectedIndex,
					one = elem.type === "select-one",
					values = one ? null : [],
					max = one ? index + 1 : options.length;

				if ( index < 0 ) {
					i = max;

				} else {
					i = one ? index : 0;
				}

				// Loop through all the selected options
				for ( ; i < max; i++ ) {
					option = options[ i ];

					// Support: IE <=9 only
					// IE8-9 doesn't update selected after form reset (#2551)
					if ( ( option.selected || i === index ) &&

							// Don't return options that are disabled or in a disabled optgroup
							!option.disabled &&
							( !option.parentNode.disabled ||
								!jQuery.nodeName( option.parentNode, "optgroup" ) ) ) {

						// Get the specific value for the option
						value = jQuery( option ).val();

						// We don't need an array for one selects
						if ( one ) {
							return value;
						}

						// Multi-Selects return an array
						values.push( value );
					}
				}

				return values;
			},

			set: function( elem, value ) {
				var optionSet, option,
					options = elem.options,
					values = jQuery.makeArray( value ),
					i = options.length;

				while ( i-- ) {
					option = options[ i ];

					/* eslint-disable no-cond-assign */

					if ( option.selected =
						jQuery.inArray( jQuery.valHooks.option.get( option ), values ) > -1
					) {
						optionSet = true;
					}

					/* eslint-enable no-cond-assign */
				}

				// Force browsers to behave consistently when non-matching value is set
				if ( !optionSet ) {
					elem.selectedIndex = -1;
				}
				return values;
			}
		}
	}
} );

// Radios and checkboxes getter/setter
jQuery.each( [ "radio", "checkbox" ], function() {
	jQuery.valHooks[ this ] = {
		set: function( elem, value ) {
			if ( jQuery.isArray( value ) ) {
				return ( elem.checked = jQuery.inArray( jQuery( elem ).val(), value ) > -1 );
			}
		}
	};
	if ( !support.checkOn ) {
		jQuery.valHooks[ this ].get = function( elem ) {
			return elem.getAttribute( "value" ) === null ? "on" : elem.value;
		};
	}
} );




// Return jQuery for attributes-only inclusion


var rfocusMorph = /^(?:focusinfocus|focusoutblur)$/;

jQuery.extend( jQuery.event, {

	trigger: function( event, data, elem, onlyHandlers ) {

		var i, cur, tmp, bubbleType, ontype, handle, special,
			eventPath = [ elem || document ],
			type = hasOwn.call( event, "type" ) ? event.type : event,
			namespaces = hasOwn.call( event, "namespace" ) ? event.namespace.split( "." ) : [];

		cur = tmp = elem = elem || document;

		// Don't do events on text and comment nodes
		if ( elem.nodeType === 3 || elem.nodeType === 8 ) {
			return;
		}

		// focus/blur morphs to focusin/out; ensure we're not firing them right now
		if ( rfocusMorph.test( type + jQuery.event.triggered ) ) {
			return;
		}

		if ( type.indexOf( "." ) > -1 ) {

			// Namespaced trigger; create a regexp to match event type in handle()
			namespaces = type.split( "." );
			type = namespaces.shift();
			namespaces.sort();
		}
		ontype = type.indexOf( ":" ) < 0 && "on" + type;

		// Caller can pass in a jQuery.Event object, Object, or just an event type string
		event = event[ jQuery.expando ] ?
			event :
			new jQuery.Event( type, typeof event === "object" && event );

		// Trigger bitmask: & 1 for native handlers; & 2 for jQuery (always true)
		event.isTrigger = onlyHandlers ? 2 : 3;
		event.namespace = namespaces.join( "." );
		event.rnamespace = event.namespace ?
			new RegExp( "(^|\\.)" + namespaces.join( "\\.(?:.*\\.|)" ) + "(\\.|$)" ) :
			null;

		// Clean up the event in case it is being reused
		event.result = undefined;
		if ( !event.target ) {
			event.target = elem;
		}

		// Clone any incoming data and prepend the event, creating the handler arg list
		data = data == null ?
			[ event ] :
			jQuery.makeArray( data, [ event ] );

		// Allow special events to draw outside the lines
		special = jQuery.event.special[ type ] || {};
		if ( !onlyHandlers && special.trigger && special.trigger.apply( elem, data ) === false ) {
			return;
		}

		// Determine event propagation path in advance, per W3C events spec (#9951)
		// Bubble up to document, then to window; watch for a global ownerDocument var (#9724)
		if ( !onlyHandlers && !special.noBubble && !jQuery.isWindow( elem ) ) {

			bubbleType = special.delegateType || type;
			if ( !rfocusMorph.test( bubbleType + type ) ) {
				cur = cur.parentNode;
			}
			for ( ; cur; cur = cur.parentNode ) {
				eventPath.push( cur );
				tmp = cur;
			}

			// Only add window if we got to document (e.g., not plain obj or detached DOM)
			if ( tmp === ( elem.ownerDocument || document ) ) {
				eventPath.push( tmp.defaultView || tmp.parentWindow || window );
			}
		}

		// Fire handlers on the event path
		i = 0;
		while ( ( cur = eventPath[ i++ ] ) && !event.isPropagationStopped() ) {

			event.type = i > 1 ?
				bubbleType :
				special.bindType || type;

			// jQuery handler
			handle = ( dataPriv.get( cur, "events" ) || {} )[ event.type ] &&
				dataPriv.get( cur, "handle" );
			if ( handle ) {
				handle.apply( cur, data );
			}

			// Native handler
			handle = ontype && cur[ ontype ];
			if ( handle && handle.apply && acceptData( cur ) ) {
				event.result = handle.apply( cur, data );
				if ( event.result === false ) {
					event.preventDefault();
				}
			}
		}
		event.type = type;

		// If nobody prevented the default action, do it now
		if ( !onlyHandlers && !event.isDefaultPrevented() ) {

			if ( ( !special._default ||
				special._default.apply( eventPath.pop(), data ) === false ) &&
				acceptData( elem ) ) {

				// Call a native DOM method on the target with the same name as the event.
				// Don't do default actions on window, that's where global variables be (#6170)
				if ( ontype && jQuery.isFunction( elem[ type ] ) && !jQuery.isWindow( elem ) ) {

					// Don't re-trigger an onFOO event when we call its FOO() method
					tmp = elem[ ontype ];

					if ( tmp ) {
						elem[ ontype ] = null;
					}

					// Prevent re-triggering of the same event, since we already bubbled it above
					jQuery.event.triggered = type;
					elem[ type ]();
					jQuery.event.triggered = undefined;

					if ( tmp ) {
						elem[ ontype ] = tmp;
					}
				}
			}
		}

		return event.result;
	},

	// Piggyback on a donor event to simulate a different one
	// Used only for `focus(in | out)` events
	simulate: function( type, elem, event ) {
		var e = jQuery.extend(
			new jQuery.Event(),
			event,
			{
				type: type,
				isSimulated: true
			}
		);

		jQuery.event.trigger( e, null, elem );
	}

} );

jQuery.fn.extend( {

	trigger: function( type, data ) {
		return this.each( function() {
			jQuery.event.trigger( type, data, this );
		} );
	},
	triggerHandler: function( type, data ) {
		var elem = this[ 0 ];
		if ( elem ) {
			return jQuery.event.trigger( type, data, elem, true );
		}
	}
} );


jQuery.each( ( "blur focus focusin focusout resize scroll click dblclick " +
	"mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave " +
	"change select submit keydown keypress keyup contextmenu" ).split( " " ),
	function( i, name ) {

	// Handle event binding
	jQuery.fn[ name ] = function( data, fn ) {
		return arguments.length > 0 ?
			this.on( name, null, data, fn ) :
			this.trigger( name );
	};
} );

jQuery.fn.extend( {
	hover: function( fnOver, fnOut ) {
		return this.mouseenter( fnOver ).mouseleave( fnOut || fnOver );
	}
} );




support.focusin = "onfocusin" in window;


// Support: Firefox <=44
// Firefox doesn't have focus(in | out) events
// Related ticket - https://bugzilla.mozilla.org/show_bug.cgi?id=687787
//
// Support: Chrome <=48 - 49, Safari <=9.0 - 9.1
// focus(in | out) events fire after focus & blur events,
// which is spec violation - http://www.w3.org/TR/DOM-Level-3-Events/#events-focusevent-event-order
// Related ticket - https://bugs.chromium.org/p/chromium/issues/detail?id=449857
if ( !support.focusin ) {
	jQuery.each( { focus: "focusin", blur: "focusout" }, function( orig, fix ) {

		// Attach a single capturing handler on the document while someone wants focusin/focusout
		var handler = function( event ) {
			jQuery.event.simulate( fix, event.target, jQuery.event.fix( event ) );
		};

		jQuery.event.special[ fix ] = {
			setup: function() {
				var doc = this.ownerDocument || this,
					attaches = dataPriv.access( doc, fix );

				if ( !attaches ) {
					doc.addEventListener( orig, handler, true );
				}
				dataPriv.access( doc, fix, ( attaches || 0 ) + 1 );
			},
			teardown: function() {
				var doc = this.ownerDocument || this,
					attaches = dataPriv.access( doc, fix ) - 1;

				if ( !attaches ) {
					doc.removeEventListener( orig, handler, true );
					dataPriv.remove( doc, fix );

				} else {
					dataPriv.access( doc, fix, attaches );
				}
			}
		};
	} );
}
var location = window.location;

var nonce = jQuery.now();

var rquery = ( /\?/ );



// Cross-browser xml parsing
jQuery.parseXML = function( data ) {
	var xml;
	if ( !data || typeof data !== "string" ) {
		return null;
	}

	// Support: IE 9 - 11 only
	// IE throws on parseFromString with invalid input.
	try {
		xml = ( new window.DOMParser() ).parseFromString( data, "text/xml" );
	} catch ( e ) {
		xml = undefined;
	}

	if ( !xml || xml.getElementsByTagName( "parsererror" ).length ) {
		jQuery.error( "Invalid XML: " + data );
	}
	return xml;
};


var
	rbracket = /\[\]$/,
	rCRLF = /\r?\n/g,
	rsubmitterTypes = /^(?:submit|button|image|reset|file)$/i,
	rsubmittable = /^(?:input|select|textarea|keygen)/i;

function buildParams( prefix, obj, traditional, add ) {
	var name;

	if ( jQuery.isArray( obj ) ) {

		// Serialize array item.
		jQuery.each( obj, function( i, v ) {
			if ( traditional || rbracket.test( prefix ) ) {

				// Treat each array item as a scalar.
				add( prefix, v );

			} else {

				// Item is non-scalar (array or object), encode its numeric index.
				buildParams(
					prefix + "[" + ( typeof v === "object" && v != null ? i : "" ) + "]",
					v,
					traditional,
					add
				);
			}
		} );

	} else if ( !traditional && jQuery.type( obj ) === "object" ) {

		// Serialize object item.
		for ( name in obj ) {
			buildParams( prefix + "[" + name + "]", obj[ name ], traditional, add );
		}

	} else {

		// Serialize scalar item.
		add( prefix, obj );
	}
}

// Serialize an array of form elements or a set of
// key/values into a query string
jQuery.param = function( a, traditional ) {
	var prefix,
		s = [],
		add = function( key, valueOrFunction ) {

			// If value is a function, invoke it and use its return value
			var value = jQuery.isFunction( valueOrFunction ) ?
				valueOrFunction() :
				valueOrFunction;

			s[ s.length ] = encodeURIComponent( key ) + "=" +
				encodeURIComponent( value == null ? "" : value );
		};

	// If an array was passed in, assume that it is an array of form elements.
	if ( jQuery.isArray( a ) || ( a.jquery && !jQuery.isPlainObject( a ) ) ) {

		// Serialize the form elements
		jQuery.each( a, function() {
			add( this.name, this.value );
		} );

	} else {

		// If traditional, encode the "old" way (the way 1.3.2 or older
		// did it), otherwise encode params recursively.
		for ( prefix in a ) {
			buildParams( prefix, a[ prefix ], traditional, add );
		}
	}

	// Return the resulting serialization
	return s.join( "&" );
};

jQuery.fn.extend( {
	serialize: function() {
		return jQuery.param( this.serializeArray() );
	},
	serializeArray: function() {
		return this.map( function() {

			// Can add propHook for "elements" to filter or add form elements
			var elements = jQuery.prop( this, "elements" );
			return elements ? jQuery.makeArray( elements ) : this;
		} )
		.filter( function() {
			var type = this.type;

			// Use .is( ":disabled" ) so that fieldset[disabled] works
			return this.name && !jQuery( this ).is( ":disabled" ) &&
				rsubmittable.test( this.nodeName ) && !rsubmitterTypes.test( type ) &&
				( this.checked || !rcheckableType.test( type ) );
		} )
		.map( function( i, elem ) {
			var val = jQuery( this ).val();

			if ( val == null ) {
				return null;
			}

			if ( jQuery.isArray( val ) ) {
				return jQuery.map( val, function( val ) {
					return { name: elem.name, value: val.replace( rCRLF, "\r\n" ) };
				} );
			}

			return { name: elem.name, value: val.replace( rCRLF, "\r\n" ) };
		} ).get();
	}
} );


var
	r20 = /%20/g,
	rhash = /#.*$/,
	rantiCache = /([?&])_=[^&]*/,
	rheaders = /^(.*?):[ \t]*([^\r\n]*)$/mg,

	// #7653, #8125, #8152: local protocol detection
	rlocalProtocol = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/,
	rnoContent = /^(?:GET|HEAD)$/,
	rprotocol = /^\/\//,

	/* Prefilters
	 * 1) They are useful to introduce custom dataTypes (see ajax/jsonp.js for an example)
	 * 2) These are called:
	 *    - BEFORE asking for a transport
	 *    - AFTER param serialization (s.data is a string if s.processData is true)
	 * 3) key is the dataType
	 * 4) the catchall symbol "*" can be used
	 * 5) execution will start with transport dataType and THEN continue down to "*" if needed
	 */
	prefilters = {},

	/* Transports bindings
	 * 1) key is the dataType
	 * 2) the catchall symbol "*" can be used
	 * 3) selection will start with transport dataType and THEN go to "*" if needed
	 */
	transports = {},

	// Avoid comment-prolog char sequence (#10098); must appease lint and evade compression
	allTypes = "*/".concat( "*" ),

	// Anchor tag for parsing the document origin
	originAnchor = document.createElement( "a" );
	originAnchor.href = location.href;

// Base "constructor" for jQuery.ajaxPrefilter and jQuery.ajaxTransport
function addToPrefiltersOrTransports( structure ) {

	// dataTypeExpression is optional and defaults to "*"
	return function( dataTypeExpression, func ) {

		if ( typeof dataTypeExpression !== "string" ) {
			func = dataTypeExpression;
			dataTypeExpression = "*";
		}

		var dataType,
			i = 0,
			dataTypes = dataTypeExpression.toLowerCase().match( rnothtmlwhite ) || [];

		if ( jQuery.isFunction( func ) ) {

			// For each dataType in the dataTypeExpression
			while ( ( dataType = dataTypes[ i++ ] ) ) {

				// Prepend if requested
				if ( dataType[ 0 ] === "+" ) {
					dataType = dataType.slice( 1 ) || "*";
					( structure[ dataType ] = structure[ dataType ] || [] ).unshift( func );

				// Otherwise append
				} else {
					( structure[ dataType ] = structure[ dataType ] || [] ).push( func );
				}
			}
		}
	};
}

// Base inspection function for prefilters and transports
function inspectPrefiltersOrTransports( structure, options, originalOptions, jqXHR ) {

	var inspected = {},
		seekingTransport = ( structure === transports );

	function inspect( dataType ) {
		var selected;
		inspected[ dataType ] = true;
		jQuery.each( structure[ dataType ] || [], function( _, prefilterOrFactory ) {
			var dataTypeOrTransport = prefilterOrFactory( options, originalOptions, jqXHR );
			if ( typeof dataTypeOrTransport === "string" &&
				!seekingTransport && !inspected[ dataTypeOrTransport ] ) {

				options.dataTypes.unshift( dataTypeOrTransport );
				inspect( dataTypeOrTransport );
				return false;
			} else if ( seekingTransport ) {
				return !( selected = dataTypeOrTransport );
			}
		} );
		return selected;
	}

	return inspect( options.dataTypes[ 0 ] ) || !inspected[ "*" ] && inspect( "*" );
}

// A special extend for ajax options
// that takes "flat" options (not to be deep extended)
// Fixes #9887
function ajaxExtend( target, src ) {
	var key, deep,
		flatOptions = jQuery.ajaxSettings.flatOptions || {};

	for ( key in src ) {
		if ( src[ key ] !== undefined ) {
			( flatOptions[ key ] ? target : ( deep || ( deep = {} ) ) )[ key ] = src[ key ];
		}
	}
	if ( deep ) {
		jQuery.extend( true, target, deep );
	}

	return target;
}

/* Handles responses to an ajax request:
 * - finds the right dataType (mediates between content-type and expected dataType)
 * - returns the corresponding response
 */
function ajaxHandleResponses( s, jqXHR, responses ) {

	var ct, type, finalDataType, firstDataType,
		contents = s.contents,
		dataTypes = s.dataTypes;

	// Remove auto dataType and get content-type in the process
	while ( dataTypes[ 0 ] === "*" ) {
		dataTypes.shift();
		if ( ct === undefined ) {
			ct = s.mimeType || jqXHR.getResponseHeader( "Content-Type" );
		}
	}

	// Check if we're dealing with a known content-type
	if ( ct ) {
		for ( type in contents ) {
			if ( contents[ type ] && contents[ type ].test( ct ) ) {
				dataTypes.unshift( type );
				break;
			}
		}
	}

	// Check to see if we have a response for the expected dataType
	if ( dataTypes[ 0 ] in responses ) {
		finalDataType = dataTypes[ 0 ];
	} else {

		// Try convertible dataTypes
		for ( type in responses ) {
			if ( !dataTypes[ 0 ] || s.converters[ type + " " + dataTypes[ 0 ] ] ) {
				finalDataType = type;
				break;
			}
			if ( !firstDataType ) {
				firstDataType = type;
			}
		}

		// Or just use first one
		finalDataType = finalDataType || firstDataType;
	}

	// If we found a dataType
	// We add the dataType to the list if needed
	// and return the corresponding response
	if ( finalDataType ) {
		if ( finalDataType !== dataTypes[ 0 ] ) {
			dataTypes.unshift( finalDataType );
		}
		return responses[ finalDataType ];
	}
}

/* Chain conversions given the request and the original response
 * Also sets the responseXXX fields on the jqXHR instance
 */
function ajaxConvert( s, response, jqXHR, isSuccess ) {
	var conv2, current, conv, tmp, prev,
		converters = {},

		// Work with a copy of dataTypes in case we need to modify it for conversion
		dataTypes = s.dataTypes.slice();

	// Create converters map with lowercased keys
	if ( dataTypes[ 1 ] ) {
		for ( conv in s.converters ) {
			converters[ conv.toLowerCase() ] = s.converters[ conv ];
		}
	}

	current = dataTypes.shift();

	// Convert to each sequential dataType
	while ( current ) {

		if ( s.responseFields[ current ] ) {
			jqXHR[ s.responseFields[ current ] ] = response;
		}

		// Apply the dataFilter if provided
		if ( !prev && isSuccess && s.dataFilter ) {
			response = s.dataFilter( response, s.dataType );
		}

		prev = current;
		current = dataTypes.shift();

		if ( current ) {

			// There's only work to do if current dataType is non-auto
			if ( current === "*" ) {

				current = prev;

			// Convert response if prev dataType is non-auto and differs from current
			} else if ( prev !== "*" && prev !== current ) {

				// Seek a direct converter
				conv = converters[ prev + " " + current ] || converters[ "* " + current ];

				// If none found, seek a pair
				if ( !conv ) {
					for ( conv2 in converters ) {

						// If conv2 outputs current
						tmp = conv2.split( " " );
						if ( tmp[ 1 ] === current ) {

							// If prev can be converted to accepted input
							conv = converters[ prev + " " + tmp[ 0 ] ] ||
								converters[ "* " + tmp[ 0 ] ];
							if ( conv ) {

								// Condense equivalence converters
								if ( conv === true ) {
									conv = converters[ conv2 ];

								// Otherwise, insert the intermediate dataType
								} else if ( converters[ conv2 ] !== true ) {
									current = tmp[ 0 ];
									dataTypes.unshift( tmp[ 1 ] );
								}
								break;
							}
						}
					}
				}

				// Apply converter (if not an equivalence)
				if ( conv !== true ) {

					// Unless errors are allowed to bubble, catch and return them
					if ( conv && s.throws ) {
						response = conv( response );
					} else {
						try {
							response = conv( response );
						} catch ( e ) {
							return {
								state: "parsererror",
								error: conv ? e : "No conversion from " + prev + " to " + current
							};
						}
					}
				}
			}
		}
	}

	return { state: "success", data: response };
}

jQuery.extend( {

	// Counter for holding the number of active queries
	active: 0,

	// Last-Modified header cache for next request
	lastModified: {},
	etag: {},

	ajaxSettings: {
		url: location.href,
		type: "GET",
		isLocal: rlocalProtocol.test( location.protocol ),
		global: true,
		processData: true,
		async: true,
		contentType: "application/x-www-form-urlencoded; charset=UTF-8",

		/*
		timeout: 0,
		data: null,
		dataType: null,
		username: null,
		password: null,
		cache: null,
		throws: false,
		traditional: false,
		headers: {},
		*/

		accepts: {
			"*": allTypes,
			text: "text/plain",
			html: "text/html",
			xml: "application/xml, text/xml",
			json: "application/json, text/javascript"
		},

		contents: {
			xml: /\bxml\b/,
			html: /\bhtml/,
			json: /\bjson\b/
		},

		responseFields: {
			xml: "responseXML",
			text: "responseText",
			json: "responseJSON"
		},

		// Data converters
		// Keys separate source (or catchall "*") and destination types with a single space
		converters: {

			// Convert anything to text
			"* text": String,

			// Text to html (true = no transformation)
			"text html": true,

			// Evaluate text as a json expression
			"text json": JSON.parse,

			// Parse text as xml
			"text xml": jQuery.parseXML
		},

		// For options that shouldn't be deep extended:
		// you can add your own custom options here if
		// and when you create one that shouldn't be
		// deep extended (see ajaxExtend)
		flatOptions: {
			url: true,
			context: true
		}
	},

	// Creates a full fledged settings object into target
	// with both ajaxSettings and settings fields.
	// If target is omitted, writes into ajaxSettings.
	ajaxSetup: function( target, settings ) {
		return settings ?

			// Building a settings object
			ajaxExtend( ajaxExtend( target, jQuery.ajaxSettings ), settings ) :

			// Extending ajaxSettings
			ajaxExtend( jQuery.ajaxSettings, target );
	},

	ajaxPrefilter: addToPrefiltersOrTransports( prefilters ),
	ajaxTransport: addToPrefiltersOrTransports( transports ),

	// Main method
	ajax: function( url, options ) {

		// If url is an object, simulate pre-1.5 signature
		if ( typeof url === "object" ) {
			options = url;
			url = undefined;
		}

		// Force options to be an object
		options = options || {};

		var transport,

			// URL without anti-cache param
			cacheURL,

			// Response headers
			responseHeadersString,
			responseHeaders,

			// timeout handle
			timeoutTimer,

			// Url cleanup var
			urlAnchor,

			// Request state (becomes false upon send and true upon completion)
			completed,

			// To know if global events are to be dispatched
			fireGlobals,

			// Loop variable
			i,

			// uncached part of the url
			uncached,

			// Create the final options object
			s = jQuery.ajaxSetup( {}, options ),

			// Callbacks context
			callbackContext = s.context || s,

			// Context for global events is callbackContext if it is a DOM node or jQuery collection
			globalEventContext = s.context &&
				( callbackContext.nodeType || callbackContext.jquery ) ?
					jQuery( callbackContext ) :
					jQuery.event,

			// Deferreds
			deferred = jQuery.Deferred(),
			completeDeferred = jQuery.Callbacks( "once memory" ),

			// Status-dependent callbacks
			statusCode = s.statusCode || {},

			// Headers (they are sent all at once)
			requestHeaders = {},
			requestHeadersNames = {},

			// Default abort message
			strAbort = "canceled",

			// Fake xhr
			jqXHR = {
				readyState: 0,

				// Builds headers hashtable if needed
				getResponseHeader: function( key ) {
					var match;
					if ( completed ) {
						if ( !responseHeaders ) {
							responseHeaders = {};
							while ( ( match = rheaders.exec( responseHeadersString ) ) ) {
								responseHeaders[ match[ 1 ].toLowerCase() ] = match[ 2 ];
							}
						}
						match = responseHeaders[ key.toLowerCase() ];
					}
					return match == null ? null : match;
				},

				// Raw string
				getAllResponseHeaders: function() {
					return completed ? responseHeadersString : null;
				},

				// Caches the header
				setRequestHeader: function( name, value ) {
					if ( completed == null ) {
						name = requestHeadersNames[ name.toLowerCase() ] =
							requestHeadersNames[ name.toLowerCase() ] || name;
						requestHeaders[ name ] = value;
					}
					return this;
				},

				// Overrides response content-type header
				overrideMimeType: function( type ) {
					if ( completed == null ) {
						s.mimeType = type;
					}
					return this;
				},

				// Status-dependent callbacks
				statusCode: function( map ) {
					var code;
					if ( map ) {
						if ( completed ) {

							// Execute the appropriate callbacks
							jqXHR.always( map[ jqXHR.status ] );
						} else {

							// Lazy-add the new callbacks in a way that preserves old ones
							for ( code in map ) {
								statusCode[ code ] = [ statusCode[ code ], map[ code ] ];
							}
						}
					}
					return this;
				},

				// Cancel the request
				abort: function( statusText ) {
					var finalText = statusText || strAbort;
					if ( transport ) {
						transport.abort( finalText );
					}
					done( 0, finalText );
					return this;
				}
			};

		// Attach deferreds
		deferred.promise( jqXHR );

		// Add protocol if not provided (prefilters might expect it)
		// Handle falsy url in the settings object (#10093: consistency with old signature)
		// We also use the url parameter if available
		s.url = ( ( url || s.url || location.href ) + "" )
			.replace( rprotocol, location.protocol + "//" );

		// Alias method option to type as per ticket #12004
		s.type = options.method || options.type || s.method || s.type;

		// Extract dataTypes list
		s.dataTypes = ( s.dataType || "*" ).toLowerCase().match( rnothtmlwhite ) || [ "" ];

		// A cross-domain request is in order when the origin doesn't match the current origin.
		if ( s.crossDomain == null ) {
			urlAnchor = document.createElement( "a" );

			// Support: IE <=8 - 11, Edge 12 - 13
			// IE throws exception on accessing the href property if url is malformed,
			// e.g. http://example.com:80x/
			try {
				urlAnchor.href = s.url;

				// Support: IE <=8 - 11 only
				// Anchor's host property isn't correctly set when s.url is relative
				urlAnchor.href = urlAnchor.href;
				s.crossDomain = originAnchor.protocol + "//" + originAnchor.host !==
					urlAnchor.protocol + "//" + urlAnchor.host;
			} catch ( e ) {

				// If there is an error parsing the URL, assume it is crossDomain,
				// it can be rejected by the transport if it is invalid
				s.crossDomain = true;
			}
		}

		// Convert data if not already a string
		if ( s.data && s.processData && typeof s.data !== "string" ) {
			s.data = jQuery.param( s.data, s.traditional );
		}

		// Apply prefilters
		inspectPrefiltersOrTransports( prefilters, s, options, jqXHR );

		// If request was aborted inside a prefilter, stop there
		if ( completed ) {
			return jqXHR;
		}

		// We can fire global events as of now if asked to
		// Don't fire events if jQuery.event is undefined in an AMD-usage scenario (#15118)
		fireGlobals = jQuery.event && s.global;

		// Watch for a new set of requests
		if ( fireGlobals && jQuery.active++ === 0 ) {
			jQuery.event.trigger( "ajaxStart" );
		}

		// Uppercase the type
		s.type = s.type.toUpperCase();

		// Determine if request has content
		s.hasContent = !rnoContent.test( s.type );

		// Save the URL in case we're toying with the If-Modified-Since
		// and/or If-None-Match header later on
		// Remove hash to simplify url manipulation
		cacheURL = s.url.replace( rhash, "" );

		// More options handling for requests with no content
		if ( !s.hasContent ) {

			// Remember the hash so we can put it back
			uncached = s.url.slice( cacheURL.length );

			// If data is available, append data to url
			if ( s.data ) {
				cacheURL += ( rquery.test( cacheURL ) ? "&" : "?" ) + s.data;

				// #9682: remove data so that it's not used in an eventual retry
				delete s.data;
			}

			// Add or update anti-cache param if needed
			if ( s.cache === false ) {
				cacheURL = cacheURL.replace( rantiCache, "$1" );
				uncached = ( rquery.test( cacheURL ) ? "&" : "?" ) + "_=" + ( nonce++ ) + uncached;
			}

			// Put hash and anti-cache on the URL that will be requested (gh-1732)
			s.url = cacheURL + uncached;

		// Change '%20' to '+' if this is encoded form body content (gh-2658)
		} else if ( s.data && s.processData &&
			( s.contentType || "" ).indexOf( "application/x-www-form-urlencoded" ) === 0 ) {
			s.data = s.data.replace( r20, "+" );
		}

		// Set the If-Modified-Since and/or If-None-Match header, if in ifModified mode.
		if ( s.ifModified ) {
			if ( jQuery.lastModified[ cacheURL ] ) {
				jqXHR.setRequestHeader( "If-Modified-Since", jQuery.lastModified[ cacheURL ] );
			}
			if ( jQuery.etag[ cacheURL ] ) {
				jqXHR.setRequestHeader( "If-None-Match", jQuery.etag[ cacheURL ] );
			}
		}

		// Set the correct header, if data is being sent
		if ( s.data && s.hasContent && s.contentType !== false || options.contentType ) {
			jqXHR.setRequestHeader( "Content-Type", s.contentType );
		}

		// Set the Accepts header for the server, depending on the dataType
		jqXHR.setRequestHeader(
			"Accept",
			s.dataTypes[ 0 ] && s.accepts[ s.dataTypes[ 0 ] ] ?
				s.accepts[ s.dataTypes[ 0 ] ] +
					( s.dataTypes[ 0 ] !== "*" ? ", " + allTypes + "; q=0.01" : "" ) :
				s.accepts[ "*" ]
		);

		// Check for headers option
		for ( i in s.headers ) {
			jqXHR.setRequestHeader( i, s.headers[ i ] );
		}

		// Allow custom headers/mimetypes and early abort
		if ( s.beforeSend &&
			( s.beforeSend.call( callbackContext, jqXHR, s ) === false || completed ) ) {

			// Abort if not done already and return
			return jqXHR.abort();
		}

		// Aborting is no longer a cancellation
		strAbort = "abort";

		// Install callbacks on deferreds
		completeDeferred.add( s.complete );
		jqXHR.done( s.success );
		jqXHR.fail( s.error );

		// Get transport
		transport = inspectPrefiltersOrTransports( transports, s, options, jqXHR );

		// If no transport, we auto-abort
		if ( !transport ) {
			done( -1, "No Transport" );
		} else {
			jqXHR.readyState = 1;

			// Send global event
			if ( fireGlobals ) {
				globalEventContext.trigger( "ajaxSend", [ jqXHR, s ] );
			}

			// If request was aborted inside ajaxSend, stop there
			if ( completed ) {
				return jqXHR;
			}

			// Timeout
			if ( s.async && s.timeout > 0 ) {
				timeoutTimer = window.setTimeout( function() {
					jqXHR.abort( "timeout" );
				}, s.timeout );
			}

			try {
				completed = false;
				transport.send( requestHeaders, done );
			} catch ( e ) {

				// Rethrow post-completion exceptions
				if ( completed ) {
					throw e;
				}

				// Propagate others as results
				done( -1, e );
			}
		}

		// Callback for when everything is done
		function done( status, nativeStatusText, responses, headers ) {
			var isSuccess, success, error, response, modified,
				statusText = nativeStatusText;

			// Ignore repeat invocations
			if ( completed ) {
				return;
			}

			completed = true;

			// Clear timeout if it exists
			if ( timeoutTimer ) {
				window.clearTimeout( timeoutTimer );
			}

			// Dereference transport for early garbage collection
			// (no matter how long the jqXHR object will be used)
			transport = undefined;

			// Cache response headers
			responseHeadersString = headers || "";

			// Set readyState
			jqXHR.readyState = status > 0 ? 4 : 0;

			// Determine if successful
			isSuccess = status >= 200 && status < 300 || status === 304;

			// Get response data
			if ( responses ) {
				response = ajaxHandleResponses( s, jqXHR, responses );
			}

			// Convert no matter what (that way responseXXX fields are always set)
			response = ajaxConvert( s, response, jqXHR, isSuccess );

			// If successful, handle type chaining
			if ( isSuccess ) {

				// Set the If-Modified-Since and/or If-None-Match header, if in ifModified mode.
				if ( s.ifModified ) {
					modified = jqXHR.getResponseHeader( "Last-Modified" );
					if ( modified ) {
						jQuery.lastModified[ cacheURL ] = modified;
					}
					modified = jqXHR.getResponseHeader( "etag" );
					if ( modified ) {
						jQuery.etag[ cacheURL ] = modified;
					}
				}

				// if no content
				if ( status === 204 || s.type === "HEAD" ) {
					statusText = "nocontent";

				// if not modified
				} else if ( status === 304 ) {
					statusText = "notmodified";

				// If we have data, let's convert it
				} else {
					statusText = response.state;
					success = response.data;
					error = response.error;
					isSuccess = !error;
				}
			} else {

				// Extract error from statusText and normalize for non-aborts
				error = statusText;
				if ( status || !statusText ) {
					statusText = "error";
					if ( status < 0 ) {
						status = 0;
					}
				}
			}

			// Set data for the fake xhr object
			jqXHR.status = status;
			jqXHR.statusText = ( nativeStatusText || statusText ) + "";

			// Success/Error
			if ( isSuccess ) {
				deferred.resolveWith( callbackContext, [ success, statusText, jqXHR ] );
			} else {
				deferred.rejectWith( callbackContext, [ jqXHR, statusText, error ] );
			}

			// Status-dependent callbacks
			jqXHR.statusCode( statusCode );
			statusCode = undefined;

			if ( fireGlobals ) {
				globalEventContext.trigger( isSuccess ? "ajaxSuccess" : "ajaxError",
					[ jqXHR, s, isSuccess ? success : error ] );
			}

			// Complete
			completeDeferred.fireWith( callbackContext, [ jqXHR, statusText ] );

			if ( fireGlobals ) {
				globalEventContext.trigger( "ajaxComplete", [ jqXHR, s ] );

				// Handle the global AJAX counter
				if ( !( --jQuery.active ) ) {
					jQuery.event.trigger( "ajaxStop" );
				}
			}
		}

		return jqXHR;
	},

	getJSON: function( url, data, callback ) {
		return jQuery.get( url, data, callback, "json" );
	},

	getScript: function( url, callback ) {
		return jQuery.get( url, undefined, callback, "script" );
	}
} );

jQuery.each( [ "get", "post" ], function( i, method ) {
	jQuery[ method ] = function( url, data, callback, type ) {

		// Shift arguments if data argument was omitted
		if ( jQuery.isFunction( data ) ) {
			type = type || callback;
			callback = data;
			data = undefined;
		}

		// The url can be an options object (which then must have .url)
		return jQuery.ajax( jQuery.extend( {
			url: url,
			type: method,
			dataType: type,
			data: data,
			success: callback
		}, jQuery.isPlainObject( url ) && url ) );
	};
} );


jQuery._evalUrl = function( url ) {
	return jQuery.ajax( {
		url: url,

		// Make this explicit, since user can override this through ajaxSetup (#11264)
		type: "GET",
		dataType: "script",
		cache: true,
		async: false,
		global: false,
		"throws": true
	} );
};


jQuery.fn.extend( {
	wrapAll: function( html ) {
		var wrap;

		if ( this[ 0 ] ) {
			if ( jQuery.isFunction( html ) ) {
				html = html.call( this[ 0 ] );
			}

			// The elements to wrap the target around
			wrap = jQuery( html, this[ 0 ].ownerDocument ).eq( 0 ).clone( true );

			if ( this[ 0 ].parentNode ) {
				wrap.insertBefore( this[ 0 ] );
			}

			wrap.map( function() {
				var elem = this;

				while ( elem.firstElementChild ) {
					elem = elem.firstElementChild;
				}

				return elem;
			} ).append( this );
		}

		return this;
	},

	wrapInner: function( html ) {
		if ( jQuery.isFunction( html ) ) {
			return this.each( function( i ) {
				jQuery( this ).wrapInner( html.call( this, i ) );
			} );
		}

		return this.each( function() {
			var self = jQuery( this ),
				contents = self.contents();

			if ( contents.length ) {
				contents.wrapAll( html );

			} else {
				self.append( html );
			}
		} );
	},

	wrap: function( html ) {
		var isFunction = jQuery.isFunction( html );

		return this.each( function( i ) {
			jQuery( this ).wrapAll( isFunction ? html.call( this, i ) : html );
		} );
	},

	unwrap: function( selector ) {
		this.parent( selector ).not( "body" ).each( function() {
			jQuery( this ).replaceWith( this.childNodes );
		} );
		return this;
	}
} );


jQuery.expr.pseudos.hidden = function( elem ) {
	return !jQuery.expr.pseudos.visible( elem );
};
jQuery.expr.pseudos.visible = function( elem ) {
	return !!( elem.offsetWidth || elem.offsetHeight || elem.getClientRects().length );
};




jQuery.ajaxSettings.xhr = function() {
	try {
		return new window.XMLHttpRequest();
	} catch ( e ) {}
};

var xhrSuccessStatus = {

		// File protocol always yields status code 0, assume 200
		0: 200,

		// Support: IE <=9 only
		// #1450: sometimes IE returns 1223 when it should be 204
		1223: 204
	},
	xhrSupported = jQuery.ajaxSettings.xhr();

support.cors = !!xhrSupported && ( "withCredentials" in xhrSupported );
support.ajax = xhrSupported = !!xhrSupported;

jQuery.ajaxTransport( function( options ) {
	var callback, errorCallback;

	// Cross domain only allowed if supported through XMLHttpRequest
	if ( support.cors || xhrSupported && !options.crossDomain ) {
		return {
			send: function( headers, complete ) {
				var i,
					xhr = options.xhr();

				xhr.open(
					options.type,
					options.url,
					options.async,
					options.username,
					options.password
				);

				// Apply custom fields if provided
				if ( options.xhrFields ) {
					for ( i in options.xhrFields ) {
						xhr[ i ] = options.xhrFields[ i ];
					}
				}

				// Override mime type if needed
				if ( options.mimeType && xhr.overrideMimeType ) {
					xhr.overrideMimeType( options.mimeType );
				}

				// X-Requested-With header
				// For cross-domain requests, seeing as conditions for a preflight are
				// akin to a jigsaw puzzle, we simply never set it to be sure.
				// (it can always be set on a per-request basis or even using ajaxSetup)
				// For same-domain requests, won't change header if already provided.
				if ( !options.crossDomain && !headers[ "X-Requested-With" ] ) {
					headers[ "X-Requested-With" ] = "XMLHttpRequest";
				}

				// Set headers
				for ( i in headers ) {
					xhr.setRequestHeader( i, headers[ i ] );
				}

				// Callback
				callback = function( type ) {
					return function() {
						if ( callback ) {
							callback = errorCallback = xhr.onload =
								xhr.onerror = xhr.onabort = xhr.onreadystatechange = null;

							if ( type === "abort" ) {
								xhr.abort();
							} else if ( type === "error" ) {

								// Support: IE <=9 only
								// On a manual native abort, IE9 throws
								// errors on any property access that is not readyState
								if ( typeof xhr.status !== "number" ) {
									complete( 0, "error" );
								} else {
									complete(

										// File: protocol always yields status 0; see #8605, #14207
										xhr.status,
										xhr.statusText
									);
								}
							} else {
								complete(
									xhrSuccessStatus[ xhr.status ] || xhr.status,
									xhr.statusText,

									// Support: IE <=9 only
									// IE9 has no XHR2 but throws on binary (trac-11426)
									// For XHR2 non-text, let the caller handle it (gh-2498)
									( xhr.responseType || "text" ) !== "text"  ||
									typeof xhr.responseText !== "string" ?
										{ binary: xhr.response } :
										{ text: xhr.responseText },
									xhr.getAllResponseHeaders()
								);
							}
						}
					};
				};

				// Listen to events
				xhr.onload = callback();
				errorCallback = xhr.onerror = callback( "error" );

				// Support: IE 9 only
				// Use onreadystatechange to replace onabort
				// to handle uncaught aborts
				if ( xhr.onabort !== undefined ) {
					xhr.onabort = errorCallback;
				} else {
					xhr.onreadystatechange = function() {

						// Check readyState before timeout as it changes
						if ( xhr.readyState === 4 ) {

							// Allow onerror to be called first,
							// but that will not handle a native abort
							// Also, save errorCallback to a variable
							// as xhr.onerror cannot be accessed
							window.setTimeout( function() {
								if ( callback ) {
									errorCallback();
								}
							} );
						}
					};
				}

				// Create the abort callback
				callback = callback( "abort" );

				try {

					// Do send the request (this may raise an exception)
					xhr.send( options.hasContent && options.data || null );
				} catch ( e ) {

					// #14683: Only rethrow if this hasn't been notified as an error yet
					if ( callback ) {
						throw e;
					}
				}
			},

			abort: function() {
				if ( callback ) {
					callback();
				}
			}
		};
	}
} );




// Prevent auto-execution of scripts when no explicit dataType was provided (See gh-2432)
jQuery.ajaxPrefilter( function( s ) {
	if ( s.crossDomain ) {
		s.contents.script = false;
	}
} );

// Install script dataType
jQuery.ajaxSetup( {
	accepts: {
		script: "text/javascript, application/javascript, " +
			"application/ecmascript, application/x-ecmascript"
	},
	contents: {
		script: /\b(?:java|ecma)script\b/
	},
	converters: {
		"text script": function( text ) {
			jQuery.globalEval( text );
			return text;
		}
	}
} );

// Handle cache's special case and crossDomain
jQuery.ajaxPrefilter( "script", function( s ) {
	if ( s.cache === undefined ) {
		s.cache = false;
	}
	if ( s.crossDomain ) {
		s.type = "GET";
	}
} );

// Bind script tag hack transport
jQuery.ajaxTransport( "script", function( s ) {

	// This transport only deals with cross domain requests
	if ( s.crossDomain ) {
		var script, callback;
		return {
			send: function( _, complete ) {
				script = jQuery( "<script>" ).prop( {
					charset: s.scriptCharset,
					src: s.url
				} ).on(
					"load error",
					callback = function( evt ) {
						script.remove();
						callback = null;
						if ( evt ) {
							complete( evt.type === "error" ? 404 : 200, evt.type );
						}
					}
				);

				// Use native DOM manipulation to avoid our domManip AJAX trickery
				document.head.appendChild( script[ 0 ] );
			},
			abort: function() {
				if ( callback ) {
					callback();
				}
			}
		};
	}
} );




var oldCallbacks = [],
	rjsonp = /(=)\?(?=&|$)|\?\?/;

// Default jsonp settings
jQuery.ajaxSetup( {
	jsonp: "callback",
	jsonpCallback: function() {
		var callback = oldCallbacks.pop() || ( jQuery.expando + "_" + ( nonce++ ) );
		this[ callback ] = true;
		return callback;
	}
} );

// Detect, normalize options and install callbacks for jsonp requests
jQuery.ajaxPrefilter( "json jsonp", function( s, originalSettings, jqXHR ) {

	var callbackName, overwritten, responseContainer,
		jsonProp = s.jsonp !== false && ( rjsonp.test( s.url ) ?
			"url" :
			typeof s.data === "string" &&
				( s.contentType || "" )
					.indexOf( "application/x-www-form-urlencoded" ) === 0 &&
				rjsonp.test( s.data ) && "data"
		);

	// Handle iff the expected data type is "jsonp" or we have a parameter to set
	if ( jsonProp || s.dataTypes[ 0 ] === "jsonp" ) {

		// Get callback name, remembering preexisting value associated with it
		callbackName = s.jsonpCallback = jQuery.isFunction( s.jsonpCallback ) ?
			s.jsonpCallback() :
			s.jsonpCallback;

		// Insert callback into url or form data
		if ( jsonProp ) {
			s[ jsonProp ] = s[ jsonProp ].replace( rjsonp, "$1" + callbackName );
		} else if ( s.jsonp !== false ) {
			s.url += ( rquery.test( s.url ) ? "&" : "?" ) + s.jsonp + "=" + callbackName;
		}

		// Use data converter to retrieve json after script execution
		s.converters[ "script json" ] = function() {
			if ( !responseContainer ) {
				jQuery.error( callbackName + " was not called" );
			}
			return responseContainer[ 0 ];
		};

		// Force json dataType
		s.dataTypes[ 0 ] = "json";

		// Install callback
		overwritten = window[ callbackName ];
		window[ callbackName ] = function() {
			responseContainer = arguments;
		};

		// Clean-up function (fires after converters)
		jqXHR.always( function() {

			// If previous value didn't exist - remove it
			if ( overwritten === undefined ) {
				jQuery( window ).removeProp( callbackName );

			// Otherwise restore preexisting value
			} else {
				window[ callbackName ] = overwritten;
			}

			// Save back as free
			if ( s[ callbackName ] ) {

				// Make sure that re-using the options doesn't screw things around
				s.jsonpCallback = originalSettings.jsonpCallback;

				// Save the callback name for future use
				oldCallbacks.push( callbackName );
			}

			// Call if it was a function and we have a response
			if ( responseContainer && jQuery.isFunction( overwritten ) ) {
				overwritten( responseContainer[ 0 ] );
			}

			responseContainer = overwritten = undefined;
		} );

		// Delegate to script
		return "script";
	}
} );




// Support: Safari 8 only
// In Safari 8 documents created via document.implementation.createHTMLDocument
// collapse sibling forms: the second one becomes a child of the first one.
// Because of that, this security measure has to be disabled in Safari 8.
// https://bugs.webkit.org/show_bug.cgi?id=137337
support.createHTMLDocument = ( function() {
	var body = document.implementation.createHTMLDocument( "" ).body;
	body.innerHTML = "<form></form><form></form>";
	return body.childNodes.length === 2;
} )();


// Argument "data" should be string of html
// context (optional): If specified, the fragment will be created in this context,
// defaults to document
// keepScripts (optional): If true, will include scripts passed in the html string
jQuery.parseHTML = function( data, context, keepScripts ) {
	if ( typeof data !== "string" ) {
		return [];
	}
	if ( typeof context === "boolean" ) {
		keepScripts = context;
		context = false;
	}

	var base, parsed, scripts;

	if ( !context ) {

		// Stop scripts or inline event handlers from being executed immediately
		// by using document.implementation
		if ( support.createHTMLDocument ) {
			context = document.implementation.createHTMLDocument( "" );

			// Set the base href for the created document
			// so any parsed elements with URLs
			// are based on the document's URL (gh-2965)
			base = context.createElement( "base" );
			base.href = document.location.href;
			context.head.appendChild( base );
		} else {
			context = document;
		}
	}

	parsed = rsingleTag.exec( data );
	scripts = !keepScripts && [];

	// Single tag
	if ( parsed ) {
		return [ context.createElement( parsed[ 1 ] ) ];
	}

	parsed = buildFragment( [ data ], context, scripts );

	if ( scripts && scripts.length ) {
		jQuery( scripts ).remove();
	}

	return jQuery.merge( [], parsed.childNodes );
};


/**
 * Load a url into a page
 */
jQuery.fn.load = function( url, params, callback ) {
	var selector, type, response,
		self = this,
		off = url.indexOf( " " );

	if ( off > -1 ) {
		selector = stripAndCollapse( url.slice( off ) );
		url = url.slice( 0, off );
	}

	// If it's a function
	if ( jQuery.isFunction( params ) ) {

		// We assume that it's the callback
		callback = params;
		params = undefined;

	// Otherwise, build a param string
	} else if ( params && typeof params === "object" ) {
		type = "POST";
	}

	// If we have elements to modify, make the request
	if ( self.length > 0 ) {
		jQuery.ajax( {
			url: url,

			// If "type" variable is undefined, then "GET" method will be used.
			// Make value of this field explicit since
			// user can override it through ajaxSetup method
			type: type || "GET",
			dataType: "html",
			data: params
		} ).done( function( responseText ) {

			// Save response for use in complete callback
			response = arguments;

			self.html( selector ?

				// If a selector was specified, locate the right elements in a dummy div
				// Exclude scripts to avoid IE 'Permission Denied' errors
				jQuery( "<div>" ).append( jQuery.parseHTML( responseText ) ).find( selector ) :

				// Otherwise use the full result
				responseText );

		// If the request succeeds, this function gets "data", "status", "jqXHR"
		// but they are ignored because response was set above.
		// If it fails, this function gets "jqXHR", "status", "error"
		} ).always( callback && function( jqXHR, status ) {
			self.each( function() {
				callback.apply( this, response || [ jqXHR.responseText, status, jqXHR ] );
			} );
		} );
	}

	return this;
};




// Attach a bunch of functions for handling common AJAX events
jQuery.each( [
	"ajaxStart",
	"ajaxStop",
	"ajaxComplete",
	"ajaxError",
	"ajaxSuccess",
	"ajaxSend"
], function( i, type ) {
	jQuery.fn[ type ] = function( fn ) {
		return this.on( type, fn );
	};
} );




jQuery.expr.pseudos.animated = function( elem ) {
	return jQuery.grep( jQuery.timers, function( fn ) {
		return elem === fn.elem;
	} ).length;
};




/**
 * Gets a window from an element
 */
function getWindow( elem ) {
	return jQuery.isWindow( elem ) ? elem : elem.nodeType === 9 && elem.defaultView;
}

jQuery.offset = {
	setOffset: function( elem, options, i ) {
		var curPosition, curLeft, curCSSTop, curTop, curOffset, curCSSLeft, calculatePosition,
			position = jQuery.css( elem, "position" ),
			curElem = jQuery( elem ),
			props = {};

		// Set position first, in-case top/left are set even on static elem
		if ( position === "static" ) {
			elem.style.position = "relative";
		}

		curOffset = curElem.offset();
		curCSSTop = jQuery.css( elem, "top" );
		curCSSLeft = jQuery.css( elem, "left" );
		calculatePosition = ( position === "absolute" || position === "fixed" ) &&
			( curCSSTop + curCSSLeft ).indexOf( "auto" ) > -1;

		// Need to be able to calculate position if either
		// top or left is auto and position is either absolute or fixed
		if ( calculatePosition ) {
			curPosition = curElem.position();
			curTop = curPosition.top;
			curLeft = curPosition.left;

		} else {
			curTop = parseFloat( curCSSTop ) || 0;
			curLeft = parseFloat( curCSSLeft ) || 0;
		}

		if ( jQuery.isFunction( options ) ) {

			// Use jQuery.extend here to allow modification of coordinates argument (gh-1848)
			options = options.call( elem, i, jQuery.extend( {}, curOffset ) );
		}

		if ( options.top != null ) {
			props.top = ( options.top - curOffset.top ) + curTop;
		}
		if ( options.left != null ) {
			props.left = ( options.left - curOffset.left ) + curLeft;
		}

		if ( "using" in options ) {
			options.using.call( elem, props );

		} else {
			curElem.css( props );
		}
	}
};

jQuery.fn.extend( {
	offset: function( options ) {

		// Preserve chaining for setter
		if ( arguments.length ) {
			return options === undefined ?
				this :
				this.each( function( i ) {
					jQuery.offset.setOffset( this, options, i );
				} );
		}

		var docElem, win, rect, doc,
			elem = this[ 0 ];

		if ( !elem ) {
			return;
		}

		// Support: IE <=11 only
		// Running getBoundingClientRect on a
		// disconnected node in IE throws an error
		if ( !elem.getClientRects().length ) {
			return { top: 0, left: 0 };
		}

		rect = elem.getBoundingClientRect();

		// Make sure element is not hidden (display: none)
		if ( rect.width || rect.height ) {
			doc = elem.ownerDocument;
			win = getWindow( doc );
			docElem = doc.documentElement;

			return {
				top: rect.top + win.pageYOffset - docElem.clientTop,
				left: rect.left + win.pageXOffset - docElem.clientLeft
			};
		}

		// Return zeros for disconnected and hidden elements (gh-2310)
		return rect;
	},

	position: function() {
		if ( !this[ 0 ] ) {
			return;
		}

		var offsetParent, offset,
			elem = this[ 0 ],
			parentOffset = { top: 0, left: 0 };

		// Fixed elements are offset from window (parentOffset = {top:0, left: 0},
		// because it is its only offset parent
		if ( jQuery.css( elem, "position" ) === "fixed" ) {

			// Assume getBoundingClientRect is there when computed position is fixed
			offset = elem.getBoundingClientRect();

		} else {

			// Get *real* offsetParent
			offsetParent = this.offsetParent();

			// Get correct offsets
			offset = this.offset();
			if ( !jQuery.nodeName( offsetParent[ 0 ], "html" ) ) {
				parentOffset = offsetParent.offset();
			}

			// Add offsetParent borders
			parentOffset = {
				top: parentOffset.top + jQuery.css( offsetParent[ 0 ], "borderTopWidth", true ),
				left: parentOffset.left + jQuery.css( offsetParent[ 0 ], "borderLeftWidth", true )
			};
		}

		// Subtract parent offsets and element margins
		return {
			top: offset.top - parentOffset.top - jQuery.css( elem, "marginTop", true ),
			left: offset.left - parentOffset.left - jQuery.css( elem, "marginLeft", true )
		};
	},

	// This method will return documentElement in the following cases:
	// 1) For the element inside the iframe without offsetParent, this method will return
	//    documentElement of the parent window
	// 2) For the hidden or detached element
	// 3) For body or html element, i.e. in case of the html node - it will return itself
	//
	// but those exceptions were never presented as a real life use-cases
	// and might be considered as more preferable results.
	//
	// This logic, however, is not guaranteed and can change at any point in the future
	offsetParent: function() {
		return this.map( function() {
			var offsetParent = this.offsetParent;

			while ( offsetParent && jQuery.css( offsetParent, "position" ) === "static" ) {
				offsetParent = offsetParent.offsetParent;
			}

			return offsetParent || documentElement;
		} );
	}
} );

// Create scrollLeft and scrollTop methods
jQuery.each( { scrollLeft: "pageXOffset", scrollTop: "pageYOffset" }, function( method, prop ) {
	var top = "pageYOffset" === prop;

	jQuery.fn[ method ] = function( val ) {
		return access( this, function( elem, method, val ) {
			var win = getWindow( elem );

			if ( val === undefined ) {
				return win ? win[ prop ] : elem[ method ];
			}

			if ( win ) {
				win.scrollTo(
					!top ? val : win.pageXOffset,
					top ? val : win.pageYOffset
				);

			} else {
				elem[ method ] = val;
			}
		}, method, val, arguments.length );
	};
} );

// Support: Safari <=7 - 9.1, Chrome <=37 - 49
// Add the top/left cssHooks using jQuery.fn.position
// Webkit bug: https://bugs.webkit.org/show_bug.cgi?id=29084
// Blink bug: https://bugs.chromium.org/p/chromium/issues/detail?id=589347
// getComputedStyle returns percent when specified for top/left/bottom/right;
// rather than make the css module depend on the offset module, just check for it here
jQuery.each( [ "top", "left" ], function( i, prop ) {
	jQuery.cssHooks[ prop ] = addGetHookIf( support.pixelPosition,
		function( elem, computed ) {
			if ( computed ) {
				computed = curCSS( elem, prop );

				// If curCSS returns percentage, fallback to offset
				return rnumnonpx.test( computed ) ?
					jQuery( elem ).position()[ prop ] + "px" :
					computed;
			}
		}
	);
} );


// Create innerHeight, innerWidth, height, width, outerHeight and outerWidth methods
jQuery.each( { Height: "height", Width: "width" }, function( name, type ) {
	jQuery.each( { padding: "inner" + name, content: type, "": "outer" + name },
		function( defaultExtra, funcName ) {

		// Margin is only for outerHeight, outerWidth
		jQuery.fn[ funcName ] = function( margin, value ) {
			var chainable = arguments.length && ( defaultExtra || typeof margin !== "boolean" ),
				extra = defaultExtra || ( margin === true || value === true ? "margin" : "border" );

			return access( this, function( elem, type, value ) {
				var doc;

				if ( jQuery.isWindow( elem ) ) {

					// $( window ).outerWidth/Height return w/h including scrollbars (gh-1729)
					return funcName.indexOf( "outer" ) === 0 ?
						elem[ "inner" + name ] :
						elem.document.documentElement[ "client" + name ];
				}

				// Get document width or height
				if ( elem.nodeType === 9 ) {
					doc = elem.documentElement;

					// Either scroll[Width/Height] or offset[Width/Height] or client[Width/Height],
					// whichever is greatest
					return Math.max(
						elem.body[ "scroll" + name ], doc[ "scroll" + name ],
						elem.body[ "offset" + name ], doc[ "offset" + name ],
						doc[ "client" + name ]
					);
				}

				return value === undefined ?

					// Get width or height on the element, requesting but not forcing parseFloat
					jQuery.css( elem, type, extra ) :

					// Set width or height on the element
					jQuery.style( elem, type, value, extra );
			}, type, chainable ? margin : undefined, chainable );
		};
	} );
} );


jQuery.fn.extend( {

	bind: function( types, data, fn ) {
		return this.on( types, null, data, fn );
	},
	unbind: function( types, fn ) {
		return this.off( types, null, fn );
	},

	delegate: function( selector, types, data, fn ) {
		return this.on( types, selector, data, fn );
	},
	undelegate: function( selector, types, fn ) {

		// ( namespace ) or ( selector, types [, fn] )
		return arguments.length === 1 ?
			this.off( selector, "**" ) :
			this.off( types, selector || "**", fn );
	}
} );

jQuery.parseJSON = JSON.parse;




// Register as a named AMD module, since jQuery can be concatenated with other
// files that may use define, but not via a proper concatenation script that
// understands anonymous AMD modules. A named AMD is safest and most robust
// way to register. Lowercase jquery is used because AMD module names are
// derived from file names, and jQuery is normally delivered in a lowercase
// file name. Do this after creating the global so that if an AMD module wants
// to call noConflict to hide this version of jQuery, it will work.

// Note that for maximum portability, libraries that are not jQuery should
// declare themselves as anonymous modules, and avoid setting a global if an
// AMD loader is present. jQuery is a special case. For more information, see
// https://github.com/jrburke/requirejs/wiki/Updating-existing-libraries#wiki-anon

if ( true ) {
	!(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_AMD_DEFINE_RESULT__ = function() {
		return jQuery;
	}.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
}




var

	// Map over jQuery in case of overwrite
	_jQuery = window.jQuery,

	// Map over the $ in case of overwrite
	_$ = window.$;

jQuery.noConflict = function( deep ) {
	if ( window.$ === jQuery ) {
		window.$ = _$;
	}

	if ( deep && window.jQuery === jQuery ) {
		window.jQuery = _jQuery;
	}

	return jQuery;
};

// Expose jQuery and $ identifiers, even in AMD
// (#7102#comment:10, https://github.com/jquery/jquery/pull/557)
// and CommonJS for browser emulators (#13566)
if ( !noGlobal ) {
	window.jQuery = window.$ = jQuery;
}





return jQuery;
} );


/***/ }),

/***/ 11:
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function($, jQuery) {
/*! main.js - v0.1.1
 * http://admindesigns.com/
 * Copyright (c) 2015 Admin Designs;*/

/* Demo theme functions. Required for
 * Settings Pane and misc functions */

var Demo = function () {

  // Demo AdminForm Functions
  var runDemoForms = function runDemoForms() {

    // Prevents directory response when submitting a demo form
    $('.admin-form').on('submit', function (e) {

      if ($('body.timeline-page').length || $('body.admin-validation-page').length) {
        return;
      }
      e.preventDefault;
      alert('Your form has submitted!');
      return false;
    });

    // give file-upload preview onclick functionality
    var fileUpload = $('.fileupload-preview');
    if (fileUpload.length) {

      fileUpload.each(function (i, e) {
        var fileForm = $(e).parents('.fileupload').find('.btn-file > input');
        $(e).on('click', function () {
          fileForm.click();
        });
      });
    }
  };

  // Demo Header Functions
  var runDemoTopbar = function runDemoTopbar() {

    // Init jQuery Multi-Select
    if ($("#topbar-multiple").length) {
      $('#topbar-multiple').multiselect({
        buttonClass: 'btn btn-default btn-sm ph15',
        dropRight: true
      });
    }
  };

  // Demo AdminForm Functions
  var runDemoSourceCode = function runDemoSourceCode() {

    var bsElement = $(".bs-component");

    if (bsElement.length) {

      // allow caching of demo resources
      $.ajaxSetup({
        cache: true
      });

      // load highlight.js plugin stylesheet from admindesigns.com
      $("<link/>", {
        rel: "stylesheet",
        type: "text/css",
        href: "http://admindesigns.com/framework/vendor/plugins/highlight/styles/github.css"
      }).appendTo("head");

      // load highlight.js plugin script from admindesigns.com
      $.getScript("http://admindesigns.com/framework/vendor/plugins/highlight/highlight.pack.js");

      // Define Source code modal
      var modalSource = '<div class="modal fade" id="source-modal" tabindex="-1" role="dialog">  ' + '<div class="modal-dialog modal-lg"> ' + '<div class="modal-content"> ' + '<div class="modal-header"> ' + '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> ' + '<h4 class="modal-title" id="myModalLabel">Source Code HTML</h4> ' + '</div> ' + '<div class="modal-body"> ' + '<div class="highlight"> ' + '<pre> ' + '<code class="language-html" data-lang="html"></code> ' + '</pre> ' + '</div> </div> ' + '<div class="modal-footer"> ' + '<button type="button" class="btn btn-primary btn-clipboard">Highlight Source</button> ' + '</div> </div> </div> </div> </div>';

      // Append modal to body
      $(modalSource).appendTo('body');

      // Code btn definition
      var codeBtn = $("<div id='source-button' class='btn btn-primary btn-xs'>&lt; &gt;</div>");
      codeBtn.click(function () {
        var html = $(this).parent().html();
        html = cleanSource(html);
        $("#source-modal pre").text(html);
        $("#source-modal").modal();

        // Init Highlight.js plugin after delay
        var source = $("#source-modal").find('pre');
        setTimeout(function () {
          source.each(function (i, block) {
            hljs.highlightBlock(block);
          });
        }, 250);

        // Highlight code text on click     
        $('.btn-clipboard').on('click', function () {
          var selection = $(this).parents('.modal-dialog').find('pre');
          selection.selectText();
        });

        $(document).keypress(function (e) {
          if (e.which == 99) {
            console.log('go');
            // highlight source code if user preses "c" key
            $('.btn-clipboard').click();
          }
        });
      });

      // Show code btn on hover
      bsElement.hover(function () {
        $(this).append(codeBtn);
        codeBtn.show();
      }, function () {
        codeBtn.hide();
      });

      // Show code modal on click
      var cleanSource = function cleanSource(html) {
        var lines = html.split(/\n/);

        lines.shift();
        lines.splice(-1, 1);

        var indentSize = lines[0].length - lines[0].trim().length,
            re = new RegExp(" {" + indentSize + "}");

        lines = lines.map(function (line) {
          if (line.match(re)) {
            line = line.substring(indentSize);
          }
          return line;
        });

        lines = lines.join("\n");
        return lines;
      };

      // Helper function to highlight code text
      jQuery.fn.selectText = function () {
        var doc = document,
            element = this[0],
            range,
            selection;
        if (doc.body.createTextRange) {
          range = document.body.createTextRange();
          range.moveToElementText(element);
          range.select();
        } else if (window.getSelection) {
          selection = window.getSelection();
          range = document.createRange();
          range.selectNodeContents(element);
          selection.removeAllRanges();
          selection.addRange(range);
        }
      };
    }
  };

  // DEMO FUNCTIONS - primarily trash
  var runDemoSettings = function runDemoSettings() {

    if ($('#skin-toolbox').length) {

      // Toggles Theme Settings Tray
      $('#skin-toolbox .panel-heading').on('click', function () {
        $('#skin-toolbox').toggleClass('toolbox-open');
      });
      // Disable text selection
      $('#skin-toolbox .panel-heading').disableSelection();

      // Cache component elements
      var Breadcrumbs = $('#topbar');
      var Sidebar = $('#sidebar_left');
      var Header = $('.navbar');
      var Branding = Header.children('.navbar-branding');

      // Possible Component Skins
      var headerSkins = "bg-primary bg-success bg-info bg-warning bg-danger bg-alert bg-system bg-dark";
      var sidebarSkins = "sidebar-light light dark";

      // Theme Settings
      var settingsObj = {
        // 'headerTone': true,
        'headerSkin': '',
        'sidebarSkin': 'sidebar-default',
        'headerState': 'navbar-fixed-top',
        'sidebarState': 'affix',
        'breadcrumbState': 'relative',
        'breadcrumbHidden': 'visible'
      };

      // Local Storage Theme Key
      var themeKey = 'admin-settings';

      // Local Storage Theme Get
      var themeGet = localStorage.getItem(themeKey);

      // Set new key if one doesn't exist
      if (themeGet === null) {
        localStorage.setItem(themeKey, JSON.stringify(settingsObj));
        themeGet = localStorage.getItem(themeKey);
      }

      // Restore Theme Settings onload from Local Storage Key
      (function () {

        var settingsParse = JSON.parse(themeGet);
        settingsObj = settingsParse;

        $.each(settingsParse, function (i, e) {
          switch (i) {
            case 'headerSkin':
              Header.removeClass(headerSkins).addClass(e);
              Branding.removeClass(headerSkins).addClass(e + ' dark');
              if (e === "bg-light") {
                Branding.removeClass(headerSkins);
              } else {
                Branding.removeClass(headerSkins).addClass(e);
              }
              $('#toolbox-header-skin input[value="bg-light"]').prop('checked', false);
              $('#toolbox-header-skin input[value="' + e + '"]').prop('checked', true);
              break;
            case 'sidebarSkin':
              Sidebar.removeClass(sidebarSkins).addClass(e);
              $('#toolbox-sidebar-skin input[value="bg-light"]').prop('checked', false);
              $('#toolbox-sidebar-skin input[value="' + e + '"]').prop('checked', true);
              break;
            case 'headerState':
              if (e === "navbar-fixed-top") {
                Header.addClass('navbar-fixed-top');
                $('#header-option').prop('checked', true);
              } else {
                Header.removeClass('navbar-fixed-top');
                $('#header-option').prop('checked', false);

                // Remove left over inline styles from nanoscroller plugin
                Sidebar.nanoScroller({
                  destroy: true
                });
                Sidebar.find('.nano-content').attr('style', '');
                Sidebar.removeClass('affix');
                $('#sidebar-option').prop('checked', false);
              }
              break;
            case 'sidebarState':
              if (e === "affix") {
                Sidebar.addClass('affix');
                $('#sidebar-option').prop('checked', true);
              } else {
                // Remove left over inline styles from nanoscroller plugin
                Sidebar.nanoScroller({
                  destroy: true
                });
                Sidebar.find('.nano-content').attr('style', '');
                Sidebar.removeClass('affix');
                $('#sidebar-option').prop('checked', false);
              }
              break;
            case 'breadcrumbState':
              if (e === "affix") {
                Breadcrumbs.addClass('affix');
                $('#breadcrumb-option').prop('checked', true);
              } else {
                Breadcrumbs.removeClass('affix');
                $('#breadcrumb-option').prop('checked', false);
              }
              break;
            case 'breadcrumbHidden':
              if (e === "hidden") {
                Breadcrumbs.addClass('hidden');
                $('#breadcrumb-hidden').prop('checked', true);
              } else {
                Breadcrumbs.removeClass('hidden');
                $('#breadcrumb-hidden').prop('checked', false);
              }
              break;
          }
        });
      })();

      // Header Skin Switcher
      $('#toolbox-header-skin input').on('click', function () {
        var This = $(this);
        var Val = This.val();
        var ID = This.attr('id');

        // Swap Header Skin
        Header.removeClass(headerSkins).addClass(Val);
        Branding.removeClass(headerSkins).addClass(Val + ' dark');

        // Save new Skin to Settings Key
        settingsObj['headerSkin'] = Val;
        localStorage.setItem(themeKey, JSON.stringify(settingsObj));
      });

      // Sidebar Skin Switcher
      $('#toolbox-sidebar-skin input').on('click', function () {
        var Val = $(this).val();

        // Swap Sidebar Skin
        Sidebar.removeClass(sidebarSkins).addClass(Val);

        // Save new Skin to Settings Key
        settingsObj['sidebarSkin'] = Val;
        localStorage.setItem(themeKey, JSON.stringify(settingsObj));
      });

      // Fixed Header Switcher
      $('#header-option').on('click', function () {
        var headerState = "navbar-fixed-top";

        if (Header.hasClass('navbar-fixed-top')) {
          Header.removeClass('navbar-fixed-top');
          headerState = "relative";

          // Remove Fixed Sidebar option if navbar isnt fixed
          Sidebar.removeClass('affix');

          // Remove left over inline styles from nanoscroller plugin
          Sidebar.nanoScroller({
            destroy: true
          });
          Sidebar.find('.nano-content').attr('style', '');
          Sidebar.removeClass('affix');
          $('#sidebar-option').prop('checked', false);

          $('#sidebar-option').parent('.checkbox-custom').addClass('checkbox-disabled').end().prop('checked', false).attr('disabled', true);
          settingsObj['sidebarState'] = "";
          localStorage.setItem(themeKey, JSON.stringify(settingsObj));

          // Remove Fixed Breadcrumb option if navbar isnt fixed
          Breadcrumbs.removeClass('affix');
          $('#breadcrumb-option').parent('.checkbox-custom').addClass('checkbox-disabled').end().prop('checked', false).attr('disabled', true);
          settingsObj['breadcrumbState'] = "";
          localStorage.setItem(themeKey, JSON.stringify(settingsObj));
        } else {
          Header.addClass('navbar-fixed-top');
          headerState = "navbar-fixed-top";
          // Enable fixed sidebar and breadcrumb options
          $('#sidebar-option').parent('.checkbox-custom').removeClass('checkbox-disabled').end().attr('disabled', false);
          $('#breadcrumb-option').parent('.checkbox-custom').removeClass('checkbox-disabled').end().attr('disabled', false);
        }

        // Save new setting to Settings Key
        settingsObj['headerState'] = headerState;
        localStorage.setItem(themeKey, JSON.stringify(settingsObj));
      });

      // Fixed Sidebar Switcher
      $('#sidebar-option').on('click', function () {
        var sidebarState = "";

        if (Sidebar.hasClass('affix')) {

          // Remove left over inline styles from nanoscroller plugin
          Sidebar.nanoScroller({
            destroy: true
          });
          Sidebar.find('.nano-content').attr('style', '');
          Sidebar.removeClass('affix');

          sidebarState = "";
        } else {
          Sidebar.addClass('affix');
          // If sidebar is fixed init nano scrollbar plugin

          if ($('.nano.affix').length) {
            $(".nano.affix").nanoScroller({
              preventPageScrolling: true
            });
          }
          sidebarState = "affix";
        }

        $(window).trigger('resize');

        // Save new setting to Settings Key
        settingsObj['sidebarState'] = sidebarState;
        localStorage.setItem(themeKey, JSON.stringify(settingsObj));
      });

      // Fixed Breadcrumb Switcher
      $('#breadcrumb-option').on('click', function () {

        var breadcrumbState = "";

        if (Breadcrumbs.hasClass('affix')) {
          Breadcrumbs.removeClass('affix');
          breadcrumbState = "";
        } else {
          Breadcrumbs.addClass('affix');
          breadcrumbState = "affix";
        }

        // Save new setting to Settings Key
        settingsObj['breadcrumbState'] = breadcrumbState;
        localStorage.setItem(themeKey, JSON.stringify(settingsObj));
      });

      // Hidden Breadcrumb Switcher
      $('#breadcrumb-hidden').on('click', function () {
        var breadcrumbState = "";

        if (Breadcrumbs.hasClass('hidden')) {
          Breadcrumbs.removeClass('hidden');
          breadcrumbState = "";
        } else {
          Breadcrumbs.addClass('hidden');
          breadcrumbState = "hidden";
        }

        // Save new setting to Settings Key
        settingsObj['breadcrumbHidden'] = breadcrumbState;
        localStorage.setItem(themeKey, JSON.stringify(settingsObj));
      });

      // Clear local storage button and confirm dialog
      $("#clearLocalStorage").on('click', function () {

        // check for Bootbox plugin - should be in core
        if (bootbox.confirm) {
          bootbox.confirm("Are You Sure?!", function (e) {

            // e returns true if user clicks "accept"
            // false if "cancel" or dismiss icon are clicked
            if (e) {
              // Timeout simply gives the user a second for the modal to
              // fade away so they can visibly see the options reset
              setTimeout(function () {
                localStorage.clear();
                location.reload();
              }, 200);
            } else {
              return;
            }
          });
        }
      });
    }
  };

  var runFullscreenDemo = function runFullscreenDemo() {

    // Fullscreen Functionality
    var screenCheck = $.fullscreen.isNativelySupported();

    // Attach handler to navbar fullscreen button
    $('.request-fullscreen').click(function () {

      // Check for fullscreen browser support
      if (screenCheck) {
        if ($.fullscreen.isFullScreen()) {
          $.fullscreen.exit();
        } else {
          $('html').fullscreen({
            overflow: 'visible'
          });
        }
      } else {
        alert('Your browser does not support fullscreen mode.');
      }
    });
  };

  return {
    init: function init() {
      runDemoForms();
      runDemoTopbar();
      runDemoSourceCode();
      runDemoSettings();
      runFullscreenDemo();
    }
  };
}();
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(0), __webpack_require__(0)))

/***/ }),

/***/ 12:
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function($) {
/*! main.js - v0.1.1
 * http://admindesigns.com/
 * Copyright (c) 2015 Admin Designs;*/

/* Core theme functions required for
 * most of the themes vital functionality */

var Core = function (options) {

   // Variables
   var Body = $('body');

   // SideMenu Functions
   var runSideMenu = function runSideMenu(options) {

      // If Nano scrollbar exist and element is fixed, init plugin
      if ($('.nano.affix').length) {
         $(".nano.affix").nanoScroller({
            preventPageScrolling: true
         });
      }

      // Sidebar state naming conventions:
      // "sb-l-o" - SideBar Left Open
      // "sb-l-c" - SideBar Left Closed
      // "sb-l-m" - SideBar Left Minified
      // Same naming convention applies to right sidebar

      // SideBar Left Toggle Function
      var sidebarLeftToggle = function sidebarLeftToggle() {

         // We check to see if the the user has closed the entire
         // leftside menu. If true we reopen it, this will result
         // in the menu resetting itself back to a minified state.
         // A second click will fully expand the menu.
         if (Body.hasClass('sb-l-c') && options.collapse === "sb-l-m") {
            Body.removeClass('sb-l-c');
         }

         // Toggle sidebar state(open/close)
         Body.toggleClass(options.collapse).removeClass('sb-r-o').addClass('sb-r-c');
         triggerResize();
      };

      // SideBar Right Toggle Function
      var sidebarRightToggle = function sidebarRightToggle() {

         // toggle sidebar state(open/close)
         if (options.siblingRope === true && !Body.hasClass('mobile-view') && Body.hasClass('sb-r-o')) {
            Body.toggleClass('sb-r-o sb-r-c').toggleClass(options.collapse);
         } else {
            Body.toggleClass('sb-r-o sb-r-c').addClass(options.collapse);
         }
         triggerResize();
      };

      // Sidebar Left Collapse Entire Menu event
      $('.sidebar-toggle-mini').on('click', function (e) {
         e.preventDefault();

         // Close Menu
         Body.addClass('sb-l-c');
         triggerResize();

         // After animation has occured we toggle the menu.
         // Upon the menu reopening the classes will be toggled
         // again, effectively restoring the menus state prior
         // to being hidden 
         if (!Body.hasClass('mobile-view')) {
            setTimeout(function () {
               Body.toggleClass('sb-l-m sb-l-o');
            }, 250);
         }
      });

      // Check window size on load
      // Adds or removes "mobile-view" class based on window size
      var sbOnLoadCheck = function sbOnLoadCheck() {
         // Check Body for classes indicating the state of Left and Right Sidebar.
         // If not found add default sidebar settings(sidebar left open, sidebar right closed).
         if (!$('body.sb-l-o').length && !$('body.sb-l-m').length && !$('body.sb-l-c').length) {
            $('body').addClass(options.sbl);
         }
         if (!$('body.sb-r-o').length && !$('body.sb-r-c').length) {
            $('body').addClass(options.sbr);
         }

         if (Body.hasClass('sb-l-m')) {
            Body.addClass('sb-l-disable-animation');
         } else {
            Body.removeClass('sb-l-disable-animation');
         }

         // If window is < 1080px wide collapse both sidebars and add ".mobile-view" class
         if ($(window).width() < 1080) {
            Body.removeClass('sb-r-o').addClass('mobile-view sb-l-m sb-r-c');
         }
      };

      // Check window size on resize
      // Adds or removes "mobile-view" class based on window size
      var sbOnResize = function sbOnResize() {

         // If window is < 1080px wide collapse both sidebars and add ".mobile-view" class
         if ($(window).width() < 1080 && !Body.hasClass('mobile-view')) {
            Body.removeClass('sb-r-o').addClass('mobile-view sb-l-m sb-r-c');
         } else if ($(window).width() > 1080) {
            Body.removeClass('mobile-view');
         } else {
            return;
         }
      };

      // Most CSS menu animations are set to 300ms. After this time
      // we trigger a single global window resize to help catch any 3rd 
      // party plugins which need the event to resize their given elements
      var triggerResize = function triggerResize() {
         setTimeout(function () {
            $(window).trigger('resize');

            if (Body.hasClass('sb-l-m')) {
               Body.addClass('sb-l-disable-animation');
            } else {
               Body.removeClass('sb-l-disable-animation');
            }
         }, 300);
      };

      // Functions Calls
      sbOnLoadCheck();
      $("#toggle_sidemenu_l").on('click', sidebarLeftToggle);
      $("#toggle_sidemenu_r").on('click', sidebarRightToggle);

      // Attach debounced resize handler
      var rescale = function rescale() {
         sbOnResize();
      };
      var lazyLayout = _.debounce(rescale, 300);
      $(window).resize(lazyLayout);

      //
      // 2. LEFT USER MENU TOGGLE
      //

      // Author Widget selector 
      var authorWidget = $('#sidebar_left .author-widget');

      // Toggle open the user menu
      $('.sidebar-menu-toggle').on('click', function (e) {
         e.preventDefault();

         // If an author widget is present we let
         // it know its sibling menu is open
         if (authorWidget.is(':visible')) {
            authorWidget.toggleClass('menu-widget-open');
         }

         // Toggle Class to signal state change
         $('.menu-widget').toggleClass('menu-widget-open').slideToggle('fast');
      });

      // 3. LEFT MENU LINKS TOGGLE
      $('.sidebar-menu li a.accordion-toggle').on('click', function (e) {

         // Any menu item with the accordion class is a dropdown submenu. Thus we prevent default actions
         e.preventDefault();

         // Any menu item with the accordion class is a dropdown submenu. Thus we prevent default actions
         if ($('body').hasClass('sb-l-m') && !$(this).parents('ul.sub-nav').length) {
            return;
         }

         // Any menu item with the accordion class is a dropdown submenu. Thus we prevent default actions
         if (!$(this).parents('ul.sub-nav').length) {
            $('a.accordion-toggle.menu-open').next('ul').slideUp('fast', 'swing', function () {
               $(this).attr('style', '').prev().removeClass('menu-open');
            });
         }
         // Any menu item with the accordion class is a dropdown submenu. Thus we prevent default actions
         else {
               var activeMenu = $(this).next('ul.sub-nav');
               var siblingMenu = $(this).parent().siblings('li').children('a.accordion-toggle.menu-open').next('ul.sub-nav');

               activeMenu.slideUp('fast', 'swing', function () {
                  $(this).attr('style', '').prev().removeClass('menu-open');
               });
               siblingMenu.slideUp('fast', 'swing', function () {
                  $(this).attr('style', '').prev().removeClass('menu-open');
               });
            }

         // Now we expand targeted menu item, add the ".open-menu" class
         // and remove any left over inline jQuery animation styles
         if (!$(this).hasClass('menu-open')) {
            $(this).next('ul').slideToggle('fast', 'swing', function () {
               $(this).attr('style', '').prev().toggleClass('menu-open');
            });
         }
      });
   };

   // Footer Functions
   var runFooter = function runFooter() {

      // Init smoothscroll on page-footer "move-to-top" button if exist
      var pageFooterBtn = $('.footer-return-top');
      if (pageFooterBtn.length) {
         pageFooterBtn.smoothScroll({ offset: -55 });
      }
   };

   // jQuery Helper Functions
   var runHelpers = function runHelpers() {

      // Disable element selection
      $.fn.disableSelection = function () {
         return this.attr('unselectable', 'on').css('user-select', 'none').on('selectstart', false);
      };

      // Find element scrollbar visibility
      $.fn.hasScrollBar = function () {
         return this.get(0).scrollHeight > this.height();
      };

      // Test for IE, Add body class if version 9
      function msieversion() {
         var ua = window.navigator.userAgent;
         var msie = ua.indexOf("MSIE ");
         if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
            var ieVersion = parseInt(ua.substring(msie + 5, ua.indexOf(".", msie)));
            if (ieVersion === 9) {
               $('body').addClass('no-js ie' + ieVersion);
            }
            return ieVersion;
         } else {
            return false;
         }
      }
      msieversion();

      // Clean up helper that removes any leftover
      // animation classes on the primary content container
      // If left it can cause z-index and visibility problems
      setTimeout(function () {
         $('#content').removeClass('animated fadeIn');
      }, 800);
   };

   // Delayed Animations
   var runAnimations = function runAnimations() {

      // Add a class after load to prevent css animations
      // from bluring pages that have load intensive resources
      setTimeout(function () {
         $('body').addClass('onload-check');
      }, 100);

      // Delayed Animations
      // data attribute accepts delay(in ms) and animation style
      // if only delay is provided fadeIn will be set as default
      // eg. data-animate='["500","fadeIn"]'
      $('.animated-delay[data-animate]').each(function () {
         var This = $(this);
         var delayTime = This.data('animate');
         var delayAnimation = 'fadeIn';

         // if the data attribute has more than 1 value
         // it's an array, reset defaults 
         if (delayTime.length > 1 && delayTime.length < 3) {
            delayTime = This.data('animate')[0];
            delayAnimation = This.data('animate')[1];
         }

         var delayAnimate = setTimeout(function () {
            This.removeClass('animated-delay').addClass('animated ' + delayAnimation).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
               This.removeClass('animated ' + delayAnimation);
            });
         }, delayTime);
      });

      // "In-View" Animations
      // data attribute accepts animation style and offset(in %)
      // eg. data-animate='["fadeIn","40%"]'
      $('.animated-waypoint').each(function (i, e) {
         var This = $(this);
         var Animation = This.data('animate');
         var offsetVal = '35%';

         // if the data attribute has more than 1 value
         // it's an array, reset defaults 
         if (Animation.length > 1 && Animation.length < 3) {
            Animation = This.data('animate')[0];
            offsetVal = This.data('animate')[1];
         }

         var waypoint = new Waypoint({
            element: This,
            handler: function handler(direction) {
               console.log(offsetVal);
               if (This.hasClass('animated-waypoint')) {
                  This.removeClass('animated-waypoint').addClass('animated ' + Animation).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                     This.removeClass('animated ' + Animation);
                  });
               }
            },
            offset: offsetVal
         });
      });
   };

   // Header Functions
   var runHeader = function runHeader() {

      // Searchbar - Mobile modifcations
      $('.navbar-search').on('click', function (e) {
         var This = $(this);
         var searchForm = This.find('input');
         var searchRemove = This.find('.search-remove');

         // Don't do anything unless in mobile mode
         if (!$('body.mobile-view').length) {
            return;
         }

         // Open search bar and add closing icon if one isn't found
         This.addClass('search-open');
         if (!searchRemove.length) {
            This.append('<div class="search-remove"></div>');
         }

         // Fadein remove btn and focus search input on animation complete
         setTimeout(function () {
            This.find('.search-remove').fadeIn();
            searchForm.focus().one('keydown', function () {
               $(this).val('');
            });
         }, 250);

         // If remove icon clicked close search bar
         if ($(e.target).attr('class') == 'search-remove') {
            This.removeClass('search-open').find('.search-remove').remove();
         }
      });

      // Init jQuery Multi-Select for navbar user dropdowns
      if ($("#user-status").length) {
         $('#user-status').multiselect({
            buttonClass: 'btn btn-default btn-sm',
            buttonWidth: 100,
            dropRight: false
         });
      }
      if ($("#user-role").length) {
         $('#user-role').multiselect({
            buttonClass: 'btn btn-default btn-sm',
            buttonWidth: 100,
            dropRight: true
         });
      }

      // Dropdown Multiselect Persist. Prevents a menu dropdown
      // from closing when a child multiselect is clicked
      $('.dropdown-menu').on('click', function (e) {

         e.stopPropagation();
         var Target = $(e.target);
         var TargetGroup = Target.parents('.btn-group');
         var SiblingGroup = Target.parents('.dropdown-menu').find('.btn-group');

         // closes all open multiselect menus. Creates Toggle like functionality
         if (Target.hasClass('multiselect') || Target.parent().hasClass('multiselect')) {
            SiblingGroup.removeClass('open');
            TargetGroup.addClass('open');
         } else {
            SiblingGroup.removeClass('open');
         }
      });

      // Sliding Topbar Metro Menu
      var menu = $('#topbar-dropmenu');
      var items = menu.find('.metro-tile');
      var metroBG = $('.metro-modal');

      // Toggle menu and active class on icon click
      $('.topbar-menu-toggle').on('click', function () {

         // If dropmenu is using alternate style we don't show modal
         if (menu.hasClass('alt')) {
            // Toggle menu and active class on icon click
            menu.slideToggle(230).toggleClass('topbar-menu-open');
            metroBG.fadeIn();
         } else {
            menu.slideToggle(230).toggleClass('topbar-menu-open');
            $(items).addClass('animated animated-short fadeInDown').css('opacity', 1);

            // Create Modal for hover effect
            if (!metroBG.length) {
               metroBG = $('<div class="metro-modal"></div>').appendTo('body');
            }
            setTimeout(function () {
               metroBG.fadeIn();
            }, 380);
         }
      });

      // If modal is clicked close menu
      $('body').on('click', '.metro-modal', function () {
         metroBG.fadeOut('fast');
         setTimeout(function () {
            menu.slideToggle(150).toggleClass('topbar-menu-open');
         }, 250);
      });
   };

   // Tray related Functions
   var runTrays = function runTrays() {

      // Match height of tray with the height of body
      var trayMatch = $('.tray[data-tray-height="match"]');
      if (trayMatch.length) {

         // Loop each tray and set height to match body
         trayMatch.each(function () {
            var bodyH = $('body').height();
            var TopbarH = $('#topbar').height();
            var NavbarH = $('.navbar').height();
            var Height = bodyH - (TopbarH + NavbarH);
            $(this).height(Height - 60);
         });
      };

      // Debounced resize handler
      var rescale = function rescale() {
         if ($(window).width() < 1000) {
            Body.addClass('tray-rescale');
         } else {
            Body.removeClass('tray-rescale tray-rescale-left tray-rescale-right');
         }
      };
      var lazyLayout = _.debounce(rescale, 300);

      if (!Body.hasClass('disable-tray-rescale')) {
         // Rescale on window resize
         $(window).resize(lazyLayout);

         // Rescale on load
         rescale();
      }

      // Perform a custom animation if tray-nav has data attribute
      var navAnimate = $('.tray-nav[data-nav-animate]');
      if (navAnimate.length) {
         var Animation = navAnimate.data('nav-animate');

         // Set default "fadeIn" animation if one has not been previously set
         if (Animation == null || Animation == true || Animation == "") {
            Animation = "fadeIn";
         }

         // Loop through each li item and add animation after set timeout
         setTimeout(function () {
            navAnimate.find('li').each(function (i, e) {
               var Timer = setTimeout(function () {
                  $(e).addClass('animated animated-short ' + Animation);
               }, 50 * i);
            });
         }, 500);
      }

      // Responsive Tray Javascript Data Helper. If browser window
      // is <575px wide (extreme mobile) we relocate the tray left/right
      // content into the element appointed by the user/data attr
      var dataTray = $('.tray[data-tray-mobile]');
      var dataAppend = dataTray.children();
      function fcRefresh() {
         if ($('body').width() < 585) {
            dataAppend.appendTo($(dataTray.data('tray-mobile')));
         } else {
            dataAppend.appendTo(dataTray);
         }
      };
      fcRefresh();

      // Attach debounced resize handler
      var fcResize = function fcResize() {
         fcRefresh();
      };
      var fcLayout = _.debounce(fcResize, 300);
      $(window).resize(fcLayout);
   };

   // Form related Functions
   var runFormElements = function runFormElements() {

      // Init Bootstrap tooltips, if present 
      var Tooltips = $("[data-toggle=tooltip]");
      if (Tooltips.length) {
         if (Tooltips.parents('#sidebar_left')) {
            Tooltips.tooltip({
               container: $('body'),
               template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
            });
         } else {
            Tooltips.tooltip();
         }
      }

      // Init Bootstrap Popovers, if present 
      var Popovers = $("[data-toggle=popover]");
      if (Popovers.length) {
         Popovers.popover();
      }

      // Init Bootstrap persistent tooltips. This prevents a
      // popup from closing if a checkbox it contains is clicked
      $('.dropdown-menu.dropdown-persist').on('click', function (e) {
         e.stopPropagation();
      });

      // Prevents a dropdown menu from closing when
      // a nav-tabs menu it contains is clicked
      $('.dropdown-menu .nav-tabs li a').on('click', function (e) {
         e.preventDefault();
         e.stopPropagation();
         $(this).tab('show');
      });

      // Prevents a dropdown menu from closing when
      // a btn-group nav menu it contains is clicked
      $('.dropdown-menu .btn-group-nav a').on('click', function (e) {
         e.preventDefault();
         e.stopPropagation();

         // Remove active class from btn-group > btns and toggle tab content
         $(this).siblings('a').removeClass('active').end().addClass('active').tab('show');
      });

      // if btn has ".btn-states" class we monitor it for user clicks. On Click we remove
      // the active class from its siblings and give it to the button clicked.
      // This gives the button set a menu like feel or state
      if ($('.btn-states').length) {
         $('.btn-states').on('click', function () {
            $(this).addClass('active').siblings().removeClass('active');
         });
      }

      // If a panel element has the ".panel-scroller" class we init
      // custom fixed height content scroller. An optional delay data attr
      // may be set. This is useful when you expect the panels height to 
      // change due to a plugin or other dynamic modification.
      var panelScroller = $('.panel-scroller');
      if (panelScroller.length) {
         panelScroller.each(function (i, e) {
            var This = $(e);
            var Delay = This.data('scroller-delay');
            var Margin = 5;

            // Check if scroller bar margin is required
            if (This.hasClass('scroller-thick')) {
               Margin = 0;
            }

            // Check if scroller bar is in a dropdown, if so 
            // we initilize scroller after dropdown is visible
            var DropMenuParent = This.parents('.dropdown-menu');
            if (DropMenuParent.length) {
               DropMenuParent.prev('.dropdown-toggle').on('click', function () {
                  setTimeout(function () {
                     This.scroller();
                     $('.navbar').scrollLock('on', 'div');
                  }, 50);
               });
               return;
            }

            if (Delay) {
               var Timer = setTimeout(function () {
                  This.scroller({ trackMargin: Margin });
                  $('#content').scrollLock('on', 'div');
               }, Delay);
            } else {
               This.scroller({ trackMargin: Margin });
               $('#content').scrollLock('on', 'div');
            }
         });
      }

      // Init smoothscroll on elements with set data attr
      // data value determines smoothscroll offset
      var SmoothScroll = $('[data-smoothscroll]');
      if (SmoothScroll.length) {
         SmoothScroll.each(function (i, e) {
            var This = $(e);
            var Offset = This.data('smoothscroll');
            var Links = This.find('a');

            // Init Smoothscroll with data stored offset
            Links.smoothScroll({
               offset: Offset
            });
         });
      }
   };
   return {
      init: function init(options) {

         // Set Default Options
         var defaults = {
            sbl: "sb-l-o", // sidebar left open onload 
            sbr: "sb-r-c", // sidebar right closed onload

            collapse: "sb-l-m", // sidebar left collapse style
            siblingRope: true
            // Setting this true will reopen the left sidebar
            // when the right sidebar is closed
         };

         // Extend Default Options.
         var options = $.extend({}, defaults, options);

         // Call Core Functions
         runHelpers();
         runAnimations();
         runHeader();
         runSideMenu(options);
         runFooter();
         runTrays();
         runFormElements();
      }

   };
}();

// Global Library of Theme colors for Javascript plug and play use  
var bgPrimary = '#4a89dc',
    bgPrimaryL = '#5d9cec',
    bgPrimaryLr = '#83aee7',
    bgPrimaryD = '#2e76d6',
    bgPrimaryDr = '#2567bd',
    bgSuccess = '#70ca63',
    bgSuccessL = '#87d37c',
    bgSuccessLr = '#9edc95',
    bgSuccessD = '#58c249',
    bgSuccessDr = '#49ae3b',
    bgInfo = '#3bafda',
    bgInfoL = '#4fc1e9',
    bgInfoLr = '#74c6e5',
    bgInfoD = '#27a0cc',
    bgInfoDr = '#2189b0',
    bgWarning = '#f6bb42',
    bgWarningL = '#ffce54',
    bgWarningLr = '#f9d283',
    bgWarningD = '#f4af22',
    bgWarningDr = '#d9950a',
    bgDanger = '#e9573f',
    bgDangerL = '#fc6e51',
    bgDangerLr = '#f08c7c',
    bgDangerD = '#e63c21',
    bgDangerDr = '#cd3117',
    bgAlert = '#967adc',
    bgAlertL = '#ac92ec',
    bgAlertLr = '#c0b0ea',
    bgAlertD = '#815fd5',
    bgAlertDr = '#6c44ce',
    bgSystem = '#37bc9b',
    bgSystemL = '#48cfad',
    bgSystemLr = '#65d2b7',
    bgSystemD = '#2fa285',
    bgSystemDr = '#288770',
    bgLight = '#f3f6f7',
    bgLightL = '#fdfefe',
    bgLightLr = '#ffffff',
    bgLightD = '#e9eef0',
    bgLightDr = '#dfe6e9',
    bgDark = '#3b3f4f',
    bgDarkL = '#424759',
    bgDarkLr = '#51566c',
    bgDarkD = '#2c2f3c',
    bgDarkDr = '#1e2028',
    bgBlack = '#283946',
    bgBlackL = '#2e4251',
    bgBlackLr = '#354a5b',
    bgBlackD = '#1c2730',
    bgBlackDr = '#0f161b';
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(0)))

/***/ }),

/***/ 13:
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(jQuery, __webpack_provided_window_dot_jQuery) {var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

/*!
 * Minified Utility Resources
 * Theme Core resources.
*/

;
(function ($) {
   var defaults = {
      width: 400,
      height: "65%",
      minimizedWidth: 200,
      gutter: 10,
      poppedOutDistance: "6%",
      title: function title() {
         return "";
      },
      dialogClass: "",
      buttons: [], /* id, html, buttonClass, click */
      animationSpeed: 400,
      opacity: 1,
      initialState: 'modal', /* "modal", "docked", "minimized" */

      showClose: true,
      showPopout: true,
      showMinimize: true,

      create: undefined,
      open: undefined,
      beforeClose: undefined,
      close: undefined,
      beforeMinimize: undefined,
      minimize: undefined,
      beforeRestore: undefined,
      restore: undefined,
      beforePopout: undefined,
      popout: undefined
   };
   var dClass = "dockmodal";
   var windowWidth = $(window).width();

   function setAnimationCSS($this, $el) {
      var aniSpeed = $this.options.animationSpeed / 1000;
      $el.css({ "transition": aniSpeed + "s right, " + aniSpeed + "s left, " + aniSpeed + "s top, " + aniSpeed + "s bottom, " + aniSpeed + "s height, " + aniSpeed + "s width" });
      return true;
   }

   function removeAnimationCSS($el) {
      $el.css({ "transition": "none" });
      return true;
   }

   var methods = {
      init: function init(options) {

         return this.each(function () {

            var $this = $(this);

            var data = $this.data('dockmodal');
            $this.options = $.extend({}, defaults, options);

            // Check to see if title is a returned function
            (function titleCheck() {
               if (typeof $this.options.title == "function") {
                  $this.options.title = $this.options.title.call($this);
               }
            })();

            // If the plugin hasn't been initialized yet
            if (!data) {
               $this.data('dockmodal', $this);
            } else {
               $("body").append($this.closest("." + dClass).show());
               //methods.restore.apply($this);
               methods.refreshLayout();
               setTimeout(function () {
                  methods.restore.apply($this);
               }, $this.options.animationSpeed);
               return;
            }

            // create modal
            var $body = $("body");
            var $window = $(window);
            var $dockModal = $('<div/>').addClass(dClass).addClass($this.options.dialogClass);
            if ($this.options.initialState == "modal") {
               $dockModal.addClass("popped-out");
            } else if ($this.options.initialState == "minimized") {
               $dockModal.addClass("minimized");
            }
            //$dockModal.width($this.options.width);
            $dockModal.height(0);
            setAnimationCSS($this, $dockModal);

            // create title
            var $dockHeader = $('<div></div>').addClass(dClass + "-header");

            if ($this.options.showClose) {
               $('<a href="#" class="header-action action-close" title="Close"><i class="icon-dockmodal-close"></i></a>').appendTo($dockHeader).click(function (e) {
                  methods.destroy.apply($this);
                  return false;
               });
            }
            if ($this.options.showPopout) {
               $('<a href="#" class="header-action action-popout" title="Pop out"><i class="icon-dockmodal-popout"></i></a>').appendTo($dockHeader).click(function (e) {
                  if ($dockModal.hasClass("popped-out")) {
                     methods.restore.apply($this);
                  } else {
                     methods.popout.apply($this);
                  }
                  return false;
               });
            }
            if ($this.options.showMinimize) {
               $('<a href="#" class="header-action action-minimize" title="Minimize"><i class="icon-dockmodal-minimize"></i></a>').appendTo($dockHeader).click(function (e) {
                  if ($dockModal.hasClass("minimized")) {
                     if ($dockModal.hasClass("popped-out")) {
                        methods.popout.apply($this);
                     } else {
                        methods.restore.apply($this);
                     }
                  } else {
                     methods.minimize.apply($this);
                  }
                  return false;
               });
            }
            if ($this.options.showMinimize && $this.options.showPopout) {
               $dockHeader.click(function () {
                  if ($dockModal.hasClass("minimized")) {
                     if ($dockModal.hasClass("popped-out")) {
                        methods.popout.apply($this);
                     } else {
                        methods.restore.apply($this);
                     }
                  } else {
                     methods.minimize.apply($this);
                  }
                  return false;
               });
            }

            $dockHeader.append('<div class="title-text">' + ($this.options.title || $this.attr("title")) + '</div>');
            $dockModal.append($dockHeader);

            // create body section
            var $placeholder = $('<div class="modal-placeholder"></div>').insertAfter($this);
            $this.placeholder = $placeholder;
            var $dockBody = $('<div></div>').addClass(dClass + "-body").append($this);
            $dockModal.append($dockBody);

            // create footer
            if ($this.options.buttons.length) {
               var $dockFooter = $('<div></div>').addClass(dClass + "-footer");
               var $dockFooterButtonset = $('<div></div>').addClass(dClass + "-footer-buttonset");
               $dockFooter.append($dockFooterButtonset);
               $.each($this.options.buttons, function (indx, el) {
                  var $btn = $('<a href="#" class="btn"></a>');
                  $btn.attr({ "id": el.id, "class": el.buttonClass });
                  $btn.html(el.html);
                  $btn.click(function (e) {
                     el.click(e, $this);
                     return false;
                  });
                  $dockFooterButtonset.append($btn);
               });
               $dockModal.append($dockFooter);
            } else {
               $dockModal.addClass("no-footer");
            }

            // create overlay
            var $overlay = $("." + dClass + "-overlay");
            if (!$overlay.length) {
               $overlay = $('<div/>').addClass(dClass + "-overlay");
            }

            // raise create event
            if ($.isFunction($this.options.create)) {
               $this.options.create($this);
            }

            $body.append($dockModal);
            $dockModal.after($overlay);
            $dockBody.focus();

            // raise open event
            if ($.isFunction($this.options.open)) {
               setTimeout(function () {
                  $this.options.open($this);
               }, $this.options.animationSpeed);
            }

            //methods.restore.apply($this);
            if ($dockModal.hasClass("minimized")) {
               $dockModal.find(".dockmodal-body, .dockmodal-footer").hide();
               methods.minimize.apply($this);
            } else {
               if ($dockModal.hasClass("popped-out")) {
                  methods.popout.apply($this);
               } else {
                  methods.restore.apply($this);
               }
            }

            // attach resize event
            // track width, set to window width
            $body.data("windowWidth", $window.width());

            $window.unbind("resize.dockmodal").bind("resize.dockmodal", function () {
               // do nothing if the width is the same
               // update new width value
               if ($window.width() == $body.data("windowWidth")) {
                  return;
               }

               $body.data("windowWidth", $window.width());
               methods.refreshLayout();
            });
         });
      },
      destroy: function destroy() {
         return this.each(function () {

            var $this = $(this).data('dockmodal');
            if (!$this) return;

            // raise beforeClose event
            if ($.isFunction($this.options.beforeClose)) {
               if ($this.options.beforeClose($this) === false) {
                  return;
               }
            }

            try {
               var $dockModal = $this.closest("." + dClass);

               if ($dockModal.hasClass("popped-out") && !$dockModal.hasClass("minimized")) {
                  $dockModal.css({
                     "left": "50%",
                     "right": "50%",
                     "top": "50%",
                     "bottom": "50%"
                  });
               } else {
                  $dockModal.css({
                     "width": "0",
                     "height": "0"
                  });
               }
               setTimeout(function () {
                  $this.removeData('dockmodal');
                  $this.placeholder.replaceWith($this);
                  $dockModal.remove();
                  $("." + dClass + "-overlay").hide();
                  methods.refreshLayout();

                  // raise close event
                  if ($.isFunction($this.options.close)) {
                     $this.options.close($this);
                  }
               }, $this.options.animationSpeed);
            } catch (err) {
               alert(err.message);
            }
            // other destroy routines
         });
      },
      close: function close() {
         methods.destroy.apply(this);
      },
      minimize: function minimize() {
         return this.each(function () {

            var $this = $(this).data('dockmodal');
            if (!$this) return;

            // raise beforeMinimize event
            if ($.isFunction($this.options.beforeMinimize)) {
               if ($this.options.beforeMinimize($this) === false) {
                  return;
               }
            }

            var $dockModal = $this.closest("." + dClass);
            var headerHeight = $dockModal.find(".dockmodal-header").outerHeight();
            $dockModal.addClass("minimized").css({
               "width": $this.options.minimizedWidth + "px",
               "height": headerHeight + "px",
               "left": "auto",
               "right": "auto",
               "top": "auto",
               "bottom": "0"
            });
            setTimeout(function () {
               // for safty, hide the body and footer
               $dockModal.find(".dockmodal-body, .dockmodal-footer").hide();

               // raise minimize event
               if ($.isFunction($this.options.minimize)) {
                  $this.options.minimize($this);
               }
            }, $this.options.animationSpeed);

            $("." + dClass + "-overlay").hide();
            $dockModal.find(".action-minimize").attr("title", "Restore");

            methods.refreshLayout();
         });
      },
      restore: function restore() {
         return this.each(function () {

            var $this = $(this).data('dockmodal');
            if (!$this) return;

            // raise beforeRestore event
            if ($.isFunction($this.options.beforeRestore)) {
               if ($this.options.beforeRestore($this) === false) {
                  return;
               }
            }

            var $dockModal = $this.closest("." + dClass);
            $dockModal.removeClass("minimized popped-out");
            $dockModal.find(".dockmodal-body, .dockmodal-footer").show();
            $dockModal.css({
               "width": $this.options.width + "px",
               "height": $this.options.height,
               "left": "auto",
               "right": "auto",
               "top": "auto",
               "bottom": "0"
            });

            $("." + dClass + "-overlay").hide();
            $dockModal.find(".action-minimize").attr("title", "Minimize");
            $dockModal.find(".action-popout").attr("title", "Pop-out");

            setTimeout(function () {
               // raise restore event
               if ($.isFunction($this.options.restore)) {
                  $this.options.restore($this);
               }
            }, $this.options.animationSpeed);

            methods.refreshLayout();
         });
      },
      popout: function popout() {
         return this.each(function () {

            var $this = $(this).data('dockmodal');
            if (!$this) return;

            // raise beforePopout event
            if ($.isFunction($this.options.beforePopout)) {
               if ($this.options.beforePopout($this) === false) {
                  return;
               }
            }

            var $dockModal = $this.closest("." + dClass);
            $dockModal.find(".dockmodal-body, .dockmodal-footer").show();

            // prepare element for animation
            removeAnimationCSS($dockModal);
            var offset = $dockModal.position();
            var windowWidth = $(window).width();
            $dockModal.css({
               "width": "auto",
               "height": "auto",
               "left": offset.left + "px",
               "right": windowWidth - offset.left - $dockModal.outerWidth(true) + "px",
               "top": offset.top + "px",
               "bottom": 0
            });

            setAnimationCSS($this, $dockModal);
            setTimeout(function () {
               $dockModal.removeClass("minimized").addClass("popped-out").css({
                  "width": "auto",
                  "height": "auto",
                  "left": $this.options.poppedOutDistance,
                  "right": $this.options.poppedOutDistance,
                  "top": $this.options.poppedOutDistance,
                  "bottom": $this.options.poppedOutDistance
               });
               $("." + dClass + "-overlay").show();
               $dockModal.find(".action-popout").attr("title", "Pop-in");

               methods.refreshLayout();
            }, 10);

            setTimeout(function () {
               // raise popout event
               if ($.isFunction($this.options.popout)) {
                  $this.options.popout($this);
               }
            }, $this.options.animationSpeed);
         });
      },
      refreshLayout: function refreshLayout() {

         var right = 0;
         var windowWidth = $(window).width();

         $.each($("." + dClass).toArray().reverse(), function (i, val) {
            var $dockModal = $(this);
            var $this = $dockModal.find("." + dClass + "-body > div").data("dockmodal");

            if ($dockModal.hasClass("popped-out") && !$dockModal.hasClass("minimized")) {
               return;
            }
            right += $this.options.gutter;
            $dockModal.css({ "right": right + "px" });
            if ($dockModal.hasClass("minimized")) {
               right += $this.options.minimizedWidth;
            } else {
               right += $this.options.width;
            }
            if (right > windowWidth) {
               $dockModal.hide();
            } else {
               setTimeout(function () {
                  $dockModal.show();
               }, $this.options.animationSpeed);
            }
         });
      }

   };

   $.fn.dockmodal = function (method) {
      if (methods[method]) {
         return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
      } else if ((typeof method === "undefined" ? "undefined" : _typeof(method)) === 'object' || !method) {
         return methods.init.apply(this, arguments);
      } else {
         $.error('Method ' + method + ' does not exist on jQuery.dockmodal');
      }
   };
})(jQuery);

;
(function ($, window, document, undefined) {

   // Plugin definition.
   $.fn.adminpanel = function (options) {

      // Default plugin options.
      var defaults = {
         grid: '.admin-grid',
         draggable: false,
         mobile: false,
         preserveGrid: false,
         onPanel: function onPanel() {
            console.log('callback:', 'onPanel');
         },
         onStart: function onStart() {
            console.log('callback:', 'onStart');
         },
         onSave: function onSave() {
            console.log('callback:', 'onSave');
         },
         onDrop: function onDrop() {
            // An "onSave" callback will also be called if
            // the drop also changes the elements DOM position
            console.log('callback:', 'onDrop');
         },
         onFinish: function onFinish() {
            console.log('callback:', 'onFinish');
         }
      };

      // Extend default options.
      var options = $.extend({}, defaults, options);

      // Variables.
      var plugin = $(this);
      var pluginID = plugin.attr('id');
      var pluginGrid = options.grid;
      var dragSetting = options.draggable;
      var mobileSetting = options.mobile;
      var preserveSetting = options.preserveGrid;
      var panels = plugin.find('.panel');

      // HTML5 LocalStorage Keys
      var settingsKey = 'panel-settings_' + location.pathname;
      var positionsKey = 'panel-positions_' + location.pathname;

      // HTML5 LocalStorage Gets
      var settingsGet = localStorage.getItem(settingsKey);
      var positionsGet = localStorage.getItem(positionsKey);

      // Control Menu Click Handler
      $('.panel').on('click', '.panel-controls > a', function (e) {
         e.preventDefault();

         // if a panel is being dragged disable menu clicks
         if ($('body.ui-drag-active').length) {
            return;
         }

         // determine appropriate event response
         methods.controlHandlers.call(this, options);
      });

      var methods = {
         init: function init(options) {
            var This = $(this);

            // onStart callback
            if (typeof options.onStart == 'function') {
               options.onStart();
            }

            // Check onload to see if positions key is empty
            if (!positionsGet) {
               localStorage.setItem(positionsKey, methods.findPositions());
            } else {
               methods.setPositions();
            }

            // Check onload to see if settings key is empty
            if (!settingsGet) {
               localStorage.setItem(settingsKey, methods.modifySettings());
            }

            // Helper function that adds unique ID's to grid elements 
            $(pluginGrid).each(function (i, e) {
               $(e).attr('id', 'grid-' + i);
            });

            // Check if empty columns should be preserved using an invisible panel
            if (preserveSetting) {
               var Panel = "<div class='panel preserve-grid'></div>";
               $(pluginGrid).each(function (i, e) {
                  $(e).append(Panel);
               });
            }

            // Prep admin panel/container prior to menu creation
            methods.createControls(options);

            // Loop through settings key and apply options to panels
            methods.applySettings();

            // Create Mobile Menus
            methods.createMobileControls(options);

            if (dragSetting === true) {
               // Activate jQuery sortable on declared grids/panels
               plugin.sortable({
                  items: plugin.find('.panel:not(".sort-disable")'),
                  connectWith: pluginGrid,
                  cursor: 'default',
                  revert: 250,
                  handle: '.panel-heading',
                  opacity: 1,
                  delay: 100,
                  tolerance: "pointer",
                  scroll: true,
                  placeholder: 'panel-placeholder',
                  forcePlaceholderSize: true,
                  forceHelperSize: true,
                  start: function start(e, ui) {
                     $('body').addClass('ui-drag-active');
                     ui.placeholder.height(ui.helper.outerHeight() - 4);
                  },
                  beforeStop: function beforeStop() {
                     // onMove callback
                     if (typeof options.onDrop == 'function') {
                        options.onDrop();
                     }
                  },
                  stop: function stop() {
                     $('body').removeClass('ui-drag-active');
                  },
                  update: function update(event, ui) {
                     // toggle loading indicator
                     methods.toggleLoader();

                     // store the positions of the plugins */
                     methods.updatePositions(options);
                  }
               });
            }

            // onFinish callback
            if (typeof options.onFinish == 'function') {
               options.onFinish();
            }
         },
         createMobileControls: function createMobileControls(options) {

            var controls = panels.find('.panel-controls');

            var arr = {};

            $.each(controls, function (i, e) {
               var This = $(e);
               var ID = $(e).parents('.panel').attr('id');

               var controlW = This.width();
               var titleW = This.siblings('.panel-title').width();
               var headingW = This.parent('.panel-heading').width();
               var mobile = controlW + titleW;
               arr[ID] = mobile;
            });
            console.log(arr);

            $.each(arr, function (i, e) {

               var This = $('#' + i);
               var headingW = This.width() - 75;
               var controls = This.find('.panel-controls');

               if (mobileSetting === true || headingW < e) {
                  This.addClass('mobile-controls');
                  var options = {
                     html: true,
                     placement: "left",
                     content: function content(e) {
                        var Content = $(this).clone();
                        return Content;
                     },
                     template: '<div data-popover-id="' + i + '" class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
                  };
                  controls.popover(options);
               } else {
                  controls.removeClass('mobile-controls');
               }
            });

            // Toggle mobile controls menu open on click
            $('.mobile-controls .panel-heading > .panel-controls').on('click', function () {
               $(this).toggleClass('panel-controls-open');
            });
         },
         applySettings: function applySettings(options) {

            // Variables.
            var obj = this;
            var localSettings = localStorage.getItem(settingsKey);
            var parseSettings = JSON.parse(localSettings);

            // Possible panel colors 
            var panelColors = "panel-primary panel-success panel-info panel-warning panel-danger panel-alert panel-system panel-dark panel-default";

            // Pull localstorage obj, parse the data, and then loop
            // through each panel and apply its given settings
            $.each(parseSettings, function (i, e) {

               $.each(e, function (i, e) {
                  var panelID = e['id'];
                  var panelTitle = e['title'];
                  var panelCollapsed = e['collapsed'];
                  var panelHidden = e['hidden'];
                  var panelColor = e['color'];
                  var Target = $('#' + panelID);

                  if (panelTitle) {
                     Target.children('.panel-heading').find('.panel-title').text(panelTitle);
                  }
                  if (panelCollapsed === 1) {
                     Target.addClass('panel-collapsed').children('.panel-body, .panel-menu, .panel-footer').hide();
                  }
                  if (panelColor) {
                     Target.removeClass(panelColors).addClass(panelColor).attr('data-panel-color', panelColor);
                  }
                  if (panelHidden === 1) {
                     Target.addClass('panel-hidden').hide().remove();
                  }
               });
            });
         },
         createControls: function createControls(options) {

            // List of available panel controls
            var panelControls = '<span class="panel-controls"></span>';
            var panelTitle = '<a href="#" class="panel-control-title"></a>';
            var panelColor = '<a href="#" class="panel-control-color"></a>';
            var panelCollapse = '<a href="#" class="panel-control-collapse"></a>';
            var panelFullscreen = '<a href="#" class="panel-control-fullscreen"></a>';
            var panelRemove = '<a href="#" class="panel-control-remove"></a>';
            var panelCallback = '<a href="#" class="panel-control-callback"></a>';
            var panelDock = '<a href="#" class="panel-control-dockable" data-toggle="popover" data-content="panelDockContent();"></a>';
            var panelExpose = '<a href="#" class="panel-control-expose"></a>';
            var panelLoader = '<a href="#" class="panel-control-loader"></a>';

            panels.each(function (i, e) {

               var This = $(e);

               // Create panel menu container
               var panelHeader = This.children('.panel-heading');
               $(panelControls).appendTo(panelHeader);

               // Check panel for settings specific attr. Use this
               // value to determine if menu item should be displayed
               var title = This.attr('data-panel-title');
               var color = This.attr('data-panel-color');
               var collapse = This.attr('data-panel-collapse');
               var fullscreen = This.attr('data-panel-fullscreen');
               var remove = This.attr('data-panel-remove');
               var callback = This.attr('data-panel-callback');
               var paneldock = This.attr('data-panel-dockable');
               var expose = This.attr('data-panel-expose');
               var loader = This.attr('data-panel-loader');

               // attach loading indicator like any other button 
               if (!loader) {
                  // Create button
                  var panelMenu = panelHeader.find('.panel-controls');
                  $(panelLoader).appendTo(panelMenu);
               }
               // Upcoming feature, not currently implemented
               if (expose) {
                  // Create button
                  var panelMenu = panelHeader.find('.panel-controls');
                  $(panelExpose).appendTo(panelMenu);
               }
               // Upcoming feature, not currently implemented
               if (paneldock) {
                  // Create button
                  var panelMenu = panelHeader.find('.panel-controls');
                  $(panelDock).appendTo(panelMenu);
               }
               // callback attr must be set true, else icon hidden
               if (callback) {
                  // Create button
                  var panelMenu = panelHeader.find('.panel-controls');
                  $(panelCallback).appendTo(panelMenu);
               }
               if (!remove) {
                  // Create button
                  var panelMenu = panelHeader.find('.panel-controls');
                  $(panelRemove).appendTo(panelMenu);
               }
               if (!title) {
                  // Create button
                  var panelMenu = panelHeader.find('.panel-controls');
                  $(panelTitle).appendTo(panelMenu);
               }
               if (!color) {
                  var panelMenu = panelHeader.find('.panel-controls');
                  $(panelColor).appendTo(panelMenu);
               }
               if (!collapse) {
                  // Create button
                  var panelMenu = panelHeader.find('.panel-controls');
                  $(panelCollapse).appendTo(panelMenu);
               }
               if (!fullscreen) {
                  // Create button
                  var panelMenu = panelHeader.find('.panel-controls');
                  $(panelFullscreen).appendTo(panelMenu);
               }
            });
         },
         controlHandlers: function controlHandlers(e) {

            var This = $(this);

            // Control button indentifiers
            var action = This.attr('class');
            var panel = This.parents('.panel');

            // Panel header variables
            var panelHeading = panel.children('.panel-heading');
            var panelTitle = panel.find('.panel-title');

            // Edit Title definition
            var panelEditTitle = function panelEditTitle() {

               // function for toggling the editbox menu
               var toggleBox = function toggleBox() {
                  var panelEditBox = panel.find('.panel-editbox');
                  panelEditBox.slideToggle('fast', function () {
                     panel.toggleClass('panel-editbox-open');

                     // Save settings to key if editbox is being closed
                     if (!panel.hasClass('panel-editbox-open')) {
                        panelTitle.text(panelEditBox.children('input').val());
                        methods.updateSettings(options);
                     }
                  });
               };

               // If editbox not found, create one and attach handlers
               if (!panel.find('.panel-editbox').length) {
                  var editBox = '<div class="panel-editbox"><input type="text" class="form-control" value="' + panelTitle.text() + '"></div>';
                  panelHeading.after(editBox);

                  // New editbox container
                  var panelEditBox = panel.find('.panel-editbox');

                  // Update panel title on key up
                  panelEditBox.children('input').on('keyup', function () {
                     panelTitle.text(panelEditBox.children('input').val());
                  });

                  // Save panel title on enter key press
                  panelEditBox.children('input').on('keypress', function (e) {
                     if (e.which == 13) {
                        toggleBox();
                     }
                  });

                  // Toggle editbox
                  toggleBox();
               } else {
                  // If found simply toggle the menu
                  toggleBox();
               }
            };

            // Panel color definition
            var panelColor = function panelColor() {

               // Create an editbox if one is not found
               if (!panel.find('.panel-colorbox').length) {
                  var colorBox = '<div class="panel-colorbox"> <span class="bg-white" data-panel-color="panel-default"></span> <span class="bg-primary" data-panel-color="panel-primary"></span> <span class="bg-info" data-panel-color="panel-info"></span> <span class="bg-success" data-panel-color="panel-success"></span> <span class="bg-warning" data-panel-color="panel-warning"></span> <span class="bg-danger" data-panel-color="panel-danger"></span> <span class="bg-alert" data-panel-color="panel-alert"></span> <span class="bg-system" data-panel-color="panel-system"></span> <span class="bg-dark" data-panel-color="panel-dark"></span> </div>';
                  panelHeading.after(colorBox);
               }

               // Editbox container
               var panelColorBox = panel.find('.panel-colorbox');

               // Update panel contextual color on click
               panelColorBox.on('click', '> span', function (e) {
                  var dataColor = $(this).data('panel-color');
                  var altColors = 'panel-primary panel-info panel-success panel-warning panel-danger panel-alert panel-system panel-dark panel-default panel-white';
                  panel.removeClass(altColors).addClass(dataColor).data('panel-color', dataColor);
                  methods.updateSettings(options);
               });

               // Toggle elements visability and '.panel-editbox' class
               // If the box is being closed update settings key
               panelColorBox.slideToggle('fast', function () {
                  panel.toggleClass('panel-colorbox-open');
               });
            };

            // Collapse definition
            var panelCollapse = function panelCollapse() {

               // Toggle class
               panel.toggleClass('panel-collapsed');

               // Toggle elements visability
               panel.children('.panel-body, .panel-menu, .panel-footer').slideToggle('fast', function () {
                  methods.updateSettings(options);
               });
            };

            // Fullscreen definition
            var panelFullscreen = function panelFullscreen() {
               // If fullscreen mode is active, remove class and enable panel sorting
               if ($('body.panel-fullscreen-active').length) {
                  $('body').removeClass('panel-fullscreen-active');
                  panel.removeClass('panel-fullscreen');
                  if (dragSetting === true) {
                     plugin.sortable("enable");
                  }
               }
               // if not active add fullscreen classes and disable panel sorting
               else {
                     $('body').addClass('panel-fullscreen-active');
                     panel.addClass('panel-fullscreen');
                     if (dragSetting === true) {
                        plugin.sortable("disable");
                     }
                  }

               // Hide any open mobile menus or popovers
               $('.panel-controls').removeClass('panel-controls-open');
               $('.popover').popover('hide');

               // Trigger a global window resize to resize any plugins
               // the fullscreened content might contain.
               setTimeout(function () {
                  $(window).trigger('resize');
               }, 100);
            };

            // Remove definition
            var panelRemove = function panelRemove() {

               // check for Bootbox plugin - should be in core
               if (bootbox.confirm) {
                  bootbox.confirm("Are You Sure?!", function (e) {

                     // e returns true if user clicks "accept"
                     // false if "cancel" or dismiss icon are clicked
                     if (e) {
                        // Timeout simply gives the user a second for the modal to
                        // fade away so they can visibly see the panel disappear
                        setTimeout(function () {
                           panel.addClass('panel-removed').hide();
                           methods.updateSettings(options);
                        }, 200);
                     }
                  });
               } else {
                  panel.addClass('panel-removed').hide();
                  methods.updateSettings(options);
               }
            };

            // Remove definition
            var panelCallback = function panelCallback() {
               if (typeof options.onPanel == 'function') {
                  options.onPanel();
               }
            };

            // Expose.js definition
            var panelExpose = function panelExpose() {
               // Code removed, feature will be added to next update
               // once all of the dynamic/responsive aspects of resizing 
               // an exposed panel are worked out                   
            };

            // Responses
            if ($(this).hasClass('panel-control-collapse')) {
               panelCollapse();
            }
            if ($(this).hasClass('panel-control-title')) {
               panelEditTitle();
            }
            if ($(this).hasClass('panel-control-color')) {
               panelColor();
            }
            if ($(this).hasClass('panel-control-fullscreen')) {
               panelFullscreen();
            }
            if ($(this).hasClass('panel-control-remove')) {
               panelRemove();
            }
            if ($(this).hasClass('panel-control-callback')) {
               panelCallback();
            }
            if ($(this).hasClass('panel-control-expose')) {
               panelExpose();
            }
            if ($(this).hasClass('panel-control-dockable')) {
               return;
            }
            if ($(this).hasClass('panel-control-loader')) {
               return;
            }

            // Toggle Loader indicator in response to action
            methods.toggleLoader.call(this);
         },
         toggleLoader: function toggleLoader(options) {
            var This = $(this);
            var panel = This.parents('.panel');

            // Add loader to panel
            panel.addClass('panel-loader-active');

            // Remove loader after specified duration
            setTimeout(function () {
               panel.removeClass('panel-loader-active');
            }, 650);
         },
         modifySettings: function modifySettings(options) {

            // Settings obj
            var settingsArr = [];

            // Determine settings of each panel.
            panels.each(function (i, e) {

               var This = $(e);
               var panelObj = {};

               // Settings variables.
               var panelID = This.attr('id');
               var panelTitle = This.children('.panel-heading').find('.panel-title').text();
               var panelCollapsed = This.hasClass('panel-collapsed') ? 1 : 0;
               var panelHidden = This.is(':hidden') ? 1 : 0;
               var panelColor = This.data('panel-color');

               panelObj['id'] = This.attr('id');
               panelObj['title'] = This.children('.panel-heading').find('.panel-title').text();
               panelObj['collapsed'] = This.hasClass('panel-collapsed') ? 1 : 0;
               panelObj['hidden'] = This.is(':hidden') ? 1 : 0;
               panelObj['color'] = panelColor ? panelColor : null;

               settingsArr.push({
                  'panel': panelObj
               });
            });

            var checkedSettings = JSON.stringify(settingsArr);

            // Log Results
            // console.log('Key contains: ', checkedSettings);

            // return panel positions array
            return checkedSettings;
         },
         findPositions: function findPositions(options) {

            var grids = plugin.find(pluginGrid);
            var gridsArr = [];

            // Determine panels present.
            grids.each(function (index, ele) {

               var panels = $(ele).find('.panel');
               var panelArr = [];

               $(ele).attr('id', 'grid-' + index);

               panels.each(function (i, e) {
                  var panelID = $(e).attr('id');
                  panelArr.push(panelID);
               });

               gridsArr[index] = panelArr;
            });

            var checkedPosition = JSON.stringify(gridsArr);

            // return panel positions array
            return checkedPosition;
         },
         setPositions: function setPositions(options) {

            // Variables
            var obj = this;
            var localPositions = localStorage.getItem(positionsKey);
            var parsePosition = JSON.parse(localPositions);

            // Pull localstorage obj, parse the data, and then loop
            // through each panel and set its position
            $(pluginGrid).each(function (i, e) {
               var rowID = $(e);
               $.each(parsePosition[i], function (i, ele) {
                  $('#' + ele).appendTo(rowID);
               });
            });
         },
         updatePositions: function updatePositions(options) {
            localStorage.setItem(positionsKey, methods.findPositions());

            // onSave callback
            if (typeof options.onSave == 'function') {
               options.onSave();
            }
         },
         updateSettings: function updateSettings(options) {
            localStorage.setItem(settingsKey, methods.modifySettings());

            // onSave callback
            if (typeof options.onSave == 'function') {
               options.onSave();
            }
         }
      };

      // Plugin implementation
      return this.each(function () {
         methods.init.call(plugin, options);
      });
   };
})(jQuery, window, document);

;

// @see https://github.com/makeusabrew/bootbox/issues/180
// @see https://github.com/makeusabrew/bootbox/issues/186
(function (root, factory) {

   "use strict";

   if (true) {
      // AMD. Register as an anonymous module.
      !(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(0)], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
				__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
				(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
   } else if ((typeof exports === "undefined" ? "undefined" : _typeof(exports)) === "object") {
      // Node. Does not work with strict CommonJS, but
      // only CommonJS-like environments that support module.exports,
      // like Node.
      module.exports = factory(require("jquery"));
   } else {
      // Browser globals (root is window)
      root.bootbox = factory(root.jQuery);
   }
})(this, function init($, undefined) {

   "use strict";

   // the base DOM structure needed to create a modal

   var templates = {
      dialog: "<div class='bootbox modal' tabindex='-1' role='dialog'>" + "<div class='modal-dialog'>" + "<div class='modal-content'>" + "<div class='modal-body'><div class='bootbox-body'></div></div>" + "</div>" + "</div>" + "</div>",
      header: "<div class='modal-header'>" + "<h4 class='modal-title'></h4>" + "</div>",
      footer: "<div class='modal-footer'></div>",
      closeButton: "<button type='button' class='bootbox-close-button close' data-dismiss='modal' aria-hidden='true'>&times;</button>",
      form: "<form class='bootbox-form'></form>",
      inputs: {
         text: "<input class='bootbox-input bootbox-input-text form-control' autocomplete=off type=text />",
         textarea: "<textarea class='bootbox-input bootbox-input-textarea form-control'></textarea>",
         email: "<input class='bootbox-input bootbox-input-email form-control' autocomplete='off' type='email' />",
         select: "<select class='bootbox-input bootbox-input-select form-control'></select>",
         checkbox: "<div class='checkbox'><label><input class='bootbox-input bootbox-input-checkbox' type='checkbox' /></label></div>",
         date: "<input class='bootbox-input bootbox-input-date form-control' autocomplete=off type='date' />",
         time: "<input class='bootbox-input bootbox-input-time form-control' autocomplete=off type='time' />",
         number: "<input class='bootbox-input bootbox-input-number form-control' autocomplete=off type='number' />",
         password: "<input class='bootbox-input bootbox-input-password form-control' autocomplete='off' type='password' />"
      }
   };

   var defaults = {
      // default language
      locale: "en",
      // show backdrop or not
      backdrop: true,
      // animate the modal in/out
      animate: true,
      // additional class string applied to the top level dialog
      className: null,
      // whether or not to enable keyboard binding
      keyboard: false,
      // whether or not to include a close button
      closeButton: true,
      // show the dialog immediately by default
      show: true,
      // dialog container
      container: "body"
   };

   // our public object; augmented after our private API
   var exports = {};

   /**
    * @private
    */
   function _t(key) {
      var locale = locales[defaults.locale];
      return locale ? locale[key] : locales.en[key];
   }

   function processCallback(e, dialog, callback) {
      e.stopPropagation();
      e.preventDefault();

      // by default we assume a callback will get rid of the dialog,
      // although it is given the opportunity to override this

      // so, if the callback can be invoked and it *explicitly returns false*
      // then we'll set a flag to keep the dialog active...
      var preserveDialog = $.isFunction(callback) && callback(e) === false;

      // ... otherwise we'll bin it
      if (!preserveDialog) {
         dialog.modal("hide");
      }
   }

   function getKeyLength(obj) {
      // @TODO defer to Object.keys(x).length if available?
      var k,
          t = 0;
      for (k in obj) {
         t++;
      }
      return t;
   }

   function each(collection, iterator) {
      var index = 0;
      $.each(collection, function (key, value) {
         iterator(key, value, index++);
      });
   }

   function sanitize(options) {
      var buttons;
      var total;

      if ((typeof options === "undefined" ? "undefined" : _typeof(options)) !== "object") {
         throw new Error("Please supply an object of options");
      }

      if (!options.message) {
         throw new Error("Please specify a message");
      }

      // make sure any supplied options take precedence over defaults
      options = $.extend({}, defaults, options);

      if (!options.buttons) {
         options.buttons = {};
      }

      // we only support Bootstrap's "static" and false backdrop args
      // supporting true would mean you could dismiss the dialog without
      // explicitly interacting with it
      options.backdrop = options.backdrop ? "static" : false;

      buttons = options.buttons;

      total = getKeyLength(buttons);

      each(buttons, function (key, button, index) {

         if ($.isFunction(button)) {
            // short form, assume value is our callback. Since button
            // isn't an object it isn't a reference either so re-assign it
            button = buttons[key] = {
               callback: button
            };
         }

         // before any further checks make sure by now button is the correct type
         if ($.type(button) !== "object") {
            throw new Error("button with key " + key + " must be an object");
         }

         if (!button.label) {
            // the lack of an explicit label means we'll assume the key is good enough
            button.label = key;
         }

         if (!button.className) {
            if (total <= 2 && index === total - 1) {
               // always add a primary to the main option in a two-button dialog
               button.className = "btn-primary";
            } else {
               button.className = "btn-default";
            }
         }
      });

      return options;
   }

   /**
    * map a flexible set of arguments into a single returned object
    * if args.length is already one just return it, otherwise
    * use the properties argument to map the unnamed args to
    * object properties
    * so in the latter case:
    * mapArguments(["foo", $.noop], ["message", "callback"])
    * -> { message: "foo", callback: $.noop }
    */
   function mapArguments(args, properties) {
      var argn = args.length;
      var options = {};

      if (argn < 1 || argn > 2) {
         throw new Error("Invalid argument length");
      }

      if (argn === 2 || typeof args[0] === "string") {
         options[properties[0]] = args[0];
         options[properties[1]] = args[1];
      } else {
         options = args[0];
      }

      return options;
   }

   /**
    * merge a set of default dialog options with user supplied arguments
    */
   function mergeArguments(defaults, args, properties) {
      return $.extend(
      // deep merge
      true,
      // ensure the target is an empty, unreferenced object
      {},
      // the base options object for this type of dialog (often just buttons)
      defaults,
      // args could be an object or array; if it's an array properties will
      // map it to a proper options object
      mapArguments(args, properties));
   }

   /**
    * this entry-level method makes heavy use of composition to take a simple
    * range of inputs and return valid options suitable for passing to bootbox.dialog
    */
   function mergeDialogOptions(className, labels, properties, args) {
      //  build up a base set of dialog properties
      var baseOptions = {
         className: "bootbox-" + className,
         buttons: createLabels.apply(null, labels)
      };

      // ensure the buttons properties generated, *after* merging
      // with user args are still valid against the supplied labels
      return validateButtons(
      // merge the generated base properties with user supplied arguments
      mergeArguments(baseOptions, args,
      // if args.length > 1, properties specify how each arg maps to an object key
      properties), labels);
   }

   /**
    * from a given list of arguments return a suitable object of button labels
    * all this does is normalise the given labels and translate them where possible
    * e.g. "ok", "confirm" -> { ok: "OK, cancel: "Annuleren" }
    */
   function createLabels() {
      var buttons = {};

      for (var i = 0, j = arguments.length; i < j; i++) {
         var argument = arguments[i];
         var key = argument.toLowerCase();
         var value = argument.toUpperCase();

         buttons[key] = {
            label: _t(value)
         };
      }

      return buttons;
   }

   function validateButtons(options, buttons) {
      var allowedButtons = {};
      each(buttons, function (key, value) {
         allowedButtons[value] = true;
      });

      each(options.buttons, function (key) {
         if (allowedButtons[key] === undefined) {
            throw new Error("button key " + key + " is not allowed (options are " + buttons.join("\n") + ")");
         }
      });

      return options;
   }

   exports.defineLocale = function (name, values) {
      if (values) {
         locales[name] = {
            OK: values.OK,
            CANCEL: values.CANCEL,
            CONFIRM: values.CONFIRM
         };
         return locales[name];
      } else {
         delete locales[name];
         return null;
      }
   };

   exports.alert = function () {
      var options;

      options = mergeDialogOptions("alert", ["ok"], ["message", "callback"], arguments);

      if (options.callback && !$.isFunction(options.callback)) {
         throw new Error("alert requires callback property to be a function when provided");
      }

      /**
       * overrides
       */
      options.buttons.ok.callback = options.onEscape = function () {
         if ($.isFunction(options.callback)) {
            return options.callback();
         }
         return true;
      };

      return exports.dialog(options);
   };

   exports.confirm = function () {
      var options;

      options = mergeDialogOptions("confirm", ["cancel", "confirm"], ["message", "callback"], arguments);

      /**
       * overrides; undo anything the user tried to set they shouldn't have
       */
      options.buttons.cancel.callback = options.onEscape = function () {
         return options.callback(false);
      };

      options.buttons.confirm.callback = function () {
         return options.callback(true);
      };

      // confirm specific validation
      if (!$.isFunction(options.callback)) {
         throw new Error("confirm requires a callback");
      }

      return exports.dialog(options);
   };

   exports.prompt = function () {
      var options;
      var defaults;
      var dialog;
      var form;
      var input;
      var shouldShow;
      var inputOptions;

      // we have to create our form first otherwise
      // its value is undefined when gearing up our options
      // @TODO this could be solved by allowing message to
      // be a function instead...
      form = $(templates.form);

      // prompt defaults are more complex than others in that
      // users can override more defaults
      // @TODO I don't like that prompt has to do a lot of heavy
      // lifting which mergeDialogOptions can *almost* support already
      // just because of 'value' and 'inputType' - can we refactor?
      defaults = {
         className: "bootbox-prompt",
         buttons: createLabels("cancel", "confirm"),
         value: "",
         inputType: "text"
      };

      options = validateButtons(mergeArguments(defaults, arguments, ["title", "callback"]), ["cancel", "confirm"]);

      // capture the user's show value; we always set this to false before
      // spawning the dialog to give us a chance to attach some handlers to
      // it, but we need to make sure we respect a preference not to show it
      shouldShow = options.show === undefined ? true : options.show;

      /**
       * overrides; undo anything the user tried to set they shouldn't have
       */
      options.message = form;

      options.buttons.cancel.callback = options.onEscape = function () {
         return options.callback(null);
      };

      options.buttons.confirm.callback = function () {
         var value;

         switch (options.inputType) {
            case "text":
            case "textarea":
            case "email":
            case "select":
            case "date":
            case "time":
            case "number":
            case "password":
               value = input.val();
               break;

            case "checkbox":
               var checkedItems = input.find("input:checked");

               // we assume that checkboxes are always multiple,
               // hence we default to an empty array
               value = [];

               each(checkedItems, function (_, item) {
                  value.push($(item).val());
               });
               break;
         }

         return options.callback(value);
      };

      options.show = false;

      // prompt specific validation
      if (!options.title) {
         throw new Error("prompt requires a title");
      }

      if (!$.isFunction(options.callback)) {
         throw new Error("prompt requires a callback");
      }

      if (!templates.inputs[options.inputType]) {
         throw new Error("invalid prompt type");
      }

      // create the input based on the supplied type
      input = $(templates.inputs[options.inputType]);

      switch (options.inputType) {
         case "text":
         case "textarea":
         case "email":
         case "date":
         case "time":
         case "number":
         case "password":
            input.val(options.value);
            break;

         case "select":
            var groups = {};
            inputOptions = options.inputOptions || [];

            if (!inputOptions.length) {
               throw new Error("prompt with select requires options");
            }

            each(inputOptions, function (_, option) {

               // assume the element to attach to is the input...
               var elem = input;

               if (option.value === undefined || option.text === undefined) {
                  throw new Error("given options in wrong format");
               }

               // ... but override that element if this option sits in a group

               if (option.group) {
                  // initialise group if necessary
                  if (!groups[option.group]) {
                     groups[option.group] = $("<optgroup/>").attr("label", option.group);
                  }

                  elem = groups[option.group];
               }

               elem.append("<option value='" + option.value + "'>" + option.text + "</option>");
            });

            each(groups, function (_, group) {
               input.append(group);
            });

            // safe to set a select's value as per a normal input
            input.val(options.value);
            break;

         case "checkbox":
            var values = $.isArray(options.value) ? options.value : [options.value];
            inputOptions = options.inputOptions || [];

            if (!inputOptions.length) {
               throw new Error("prompt with checkbox requires options");
            }

            if (!inputOptions[0].value || !inputOptions[0].text) {
               throw new Error("given options in wrong format");
            }

            // checkboxes have to nest within a containing element, so
            // they break the rules a bit and we end up re-assigning
            // our 'input' element to this container instead
            input = $("<div/>");

            each(inputOptions, function (_, option) {
               var checkbox = $(templates.inputs[options.inputType]);

               checkbox.find("input").attr("value", option.value);
               checkbox.find("label").append(option.text);

               // we've ensured values is an array so we can always iterate over it
               each(values, function (_, value) {
                  if (value === option.value) {
                     checkbox.find("input").prop("checked", true);
                  }
               });

               input.append(checkbox);
            });
            break;
      }

      if (options.placeholder) {
         input.attr("placeholder", options.placeholder);
      }

      if (options.pattern) {
         input.attr("pattern", options.pattern);
      }

      // now place it in our form
      form.append(input);

      form.on("submit", function (e) {
         e.preventDefault();
         // Fix for SammyJS (or similar JS routing library) hijacking the form post.
         e.stopPropagation();
         // @TODO can we actually click *the* button object instead?
         // e.g. buttons.confirm.click() or similar
         dialog.find(".btn-primary").click();
      });

      dialog = exports.dialog(options);

      // clear the existing handler focusing the submit button...
      dialog.off("shown.bs.modal");

      // ...and replace it with one focusing our input, if possible
      dialog.on("shown.bs.modal", function () {
         input.focus();
      });

      if (shouldShow === true) {
         dialog.modal("show");
      }

      return dialog;
   };

   exports.dialog = function (options) {
      options = sanitize(options);

      var dialog = $(templates.dialog);
      var innerDialog = dialog.find(".modal-dialog");
      var body = dialog.find(".modal-body");
      var buttons = options.buttons;
      var buttonStr = "";
      var callbacks = {
         onEscape: options.onEscape
      };

      if ($.fn.modal === undefined) {
         throw new Error("$.fn.modal is not defined; please double check you have included " + "the Bootstrap JavaScript library. See http://getbootstrap.com/javascript/ " + "for more details.");
      }

      each(buttons, function (key, button) {

         // @TODO I don't like this string appending to itself; bit dirty. Needs reworking
         // can we just build up button elements instead? slower but neater. Then button
         // can just become a template too
         buttonStr += "<button data-bb-handler='" + key + "' type='button' class='btn " + button.className + "'>" + button.label + "</button>";
         callbacks[key] = button.callback;
      });

      body.find(".bootbox-body").html(options.message);

      if (options.animate === true) {
         dialog.addClass("fade");
      }

      if (options.className) {
         dialog.addClass(options.className);
      }

      if (options.size === "large") {
         innerDialog.addClass("modal-lg");
      }

      if (options.size === "small") {
         innerDialog.addClass("modal-sm");
      }

      if (options.title) {
         body.before(templates.header);
      }

      if (options.closeButton) {
         var closeButton = $(templates.closeButton);

         if (options.title) {
            dialog.find(".modal-header").prepend(closeButton);
         } else {
            closeButton.css("margin-top", "-10px").prependTo(body);
         }
      }

      if (options.title) {
         dialog.find(".modal-title").html(options.title);
      }

      if (buttonStr.length) {
         body.after(templates.footer);
         dialog.find(".modal-footer").html(buttonStr);
      }

      /**
       * Bootstrap event listeners; used handle extra
       * setup & teardown required after the underlying
       * modal has performed certain actions
       */

      dialog.on("hidden.bs.modal", function (e) {
         // ensure we don't accidentally intercept hidden events triggered
         // by children of the current dialog. We shouldn't anymore now BS
         // namespaces its events; but still worth doing
         if (e.target === this) {
            dialog.remove();
         }
      });

      /*
      dialog.on("show.bs.modal", function() {
        // sadly this doesn't work; show is called *just* before
        // the backdrop is added so we'd need a setTimeout hack or
        // otherwise... leaving in as would be nice
        if (options.backdrop) {
          dialog.next(".modal-backdrop").addClass("bootbox-backdrop");
        }
      });
      */

      dialog.on("shown.bs.modal", function () {
         dialog.find(".btn-primary:first").focus();
      });

      /**
       * Bootbox event listeners; experimental and may not last
       * just an attempt to decouple some behaviours from their
       * respective triggers
       */

      dialog.on("escape.close.bb", function (e) {
         if (callbacks.onEscape) {
            processCallback(e, dialog, callbacks.onEscape);
         }
      });

      /**
       * Standard jQuery event listeners; used to handle user
       * interaction with our dialog
       */

      dialog.on("click", ".modal-footer button", function (e) {
         var callbackKey = $(this).data("bb-handler");

         processCallback(e, dialog, callbacks[callbackKey]);
      });

      dialog.on("click", ".bootbox-close-button", function (e) {
         // onEscape might be falsy but that's fine; the fact is
         // if the user has managed to click the close button we
         // have to close the dialog, callback or not
         processCallback(e, dialog, callbacks.onEscape);
      });

      dialog.on("keyup", function (e) {
         if (e.which === 27) {
            dialog.trigger("escape.close.bb");
         }
      });

      // the remainder of this method simply deals with adding our
      // dialogent to the DOM, augmenting it with Bootstrap's modal
      // functionality and then giving the resulting object back
      // to our caller

      $(options.container).append(dialog);

      dialog.modal({
         backdrop: options.backdrop,
         keyboard: options.keyboard || false,
         show: false
      });

      if (options.show) {
         dialog.modal("show");
      }

      // @TODO should we return the raw element here or should
      // we wrap it in an object on which we can expose some neater
      // methods, e.g. var d = bootbox.alert(); d.hide(); instead
      // of d.modal("hide");

      /*
       function BBDialog(elem) {
         this.elem = elem;
       }
         BBDialog.prototype = {
         hide: function() {
           return this.elem.modal("hide");
         },
         show: function() {
           return this.elem.modal("show");
         }
       };
       */

      return dialog;
   };

   exports.setDefaults = function () {
      var values = {};

      if (arguments.length === 2) {
         // allow passing of single key/value...
         values[arguments[0]] = arguments[1];
      } else {
         // ... and as an object too
         values = arguments[0];
      }

      $.extend(defaults, values);
   };

   exports.hideAll = function () {
      $(".bootbox").modal("hide");

      return exports;
   };

   /**
    * standard locales. Please add more according to ISO 639-1 standard. Multiple language variants are
    * unlikely to be required. If this gets too large it can be split out into separate JS files.
    */
   var locales = {
      br: {
         OK: "OK",
         CANCEL: "Cancelar",
         CONFIRM: "Sim"
      },
      cs: {
         OK: "OK",
         CANCEL: "Zrušit",
         CONFIRM: "Potvrdit"
      },
      da: {
         OK: "OK",
         CANCEL: "Annuller",
         CONFIRM: "Accepter"
      },
      de: {
         OK: "OK",
         CANCEL: "Abbrechen",
         CONFIRM: "Akzeptieren"
      },
      el: {
         OK: "Εντάξει",
         CANCEL: "Ακύρωση",
         CONFIRM: "Επιβεβαίωση"
      },
      en: {
         OK: "OK",
         CANCEL: "Cancel",
         CONFIRM: "OK"
      },
      es: {
         OK: "OK",
         CANCEL: "Cancelar",
         CONFIRM: "Aceptar"
      },
      et: {
         OK: "OK",
         CANCEL: "Katkesta",
         CONFIRM: "OK"
      },
      fi: {
         OK: "OK",
         CANCEL: "Peruuta",
         CONFIRM: "OK"
      },
      fr: {
         OK: "OK",
         CANCEL: "Annuler",
         CONFIRM: "D'accord"
      },
      he: {
         OK: "אישור",
         CANCEL: "ביטול",
         CONFIRM: "אישור"
      },
      hu: {
         OK: "OK",
         CANCEL: "Mégsem",
         CONFIRM: "Megerősít"
      },
      hr: {
         OK: "OK",
         CANCEL: "Odustani",
         CONFIRM: "Potvrdi"
      },
      id: {
         OK: "OK",
         CANCEL: "Batal",
         CONFIRM: "OK"
      },
      it: {
         OK: "OK",
         CANCEL: "Annulla",
         CONFIRM: "Conferma"
      },
      ja: {
         OK: "OK",
         CANCEL: "キャンセル",
         CONFIRM: "確認"
      },
      lt: {
         OK: "Gerai",
         CANCEL: "Atšaukti",
         CONFIRM: "Patvirtinti"
      },
      lv: {
         OK: "Labi",
         CANCEL: "Atcelt",
         CONFIRM: "Apstiprināt"
      },
      nl: {
         OK: "OK",
         CANCEL: "Annuleren",
         CONFIRM: "Accepteren"
      },
      no: {
         OK: "OK",
         CANCEL: "Avbryt",
         CONFIRM: "OK"
      },
      pl: {
         OK: "OK",
         CANCEL: "Anuluj",
         CONFIRM: "Potwierdź"
      },
      pt: {
         OK: "OK",
         CANCEL: "Cancelar",
         CONFIRM: "Confirmar"
      },
      ru: {
         OK: "OK",
         CANCEL: "Отмена",
         CONFIRM: "Применить"
      },
      sv: {
         OK: "OK",
         CANCEL: "Avbryt",
         CONFIRM: "OK"
      },
      tr: {
         OK: "Tamam",
         CANCEL: "İptal",
         CONFIRM: "Onayla"
      },
      zh_CN: {
         OK: "OK",
         CANCEL: "取消",
         CONFIRM: "确认"
      },
      zh_TW: {
         OK: "OK",
         CANCEL: "取消",
         CONFIRM: "確認"
      }
   };

   exports.init = function (_$) {
      return init(_$ || $);
   };

   return exports;
});

;
(function ($) {

   function defined(a) {
      return typeof a !== 'undefined';
   }

   function extend(child, parent, prototype) {
      var F = function F() {};
      F.prototype = parent.prototype;
      child.prototype = new F();
      child.prototype.constructor = child;
      parent.prototype.constructor = parent;
      child._super = parent.prototype;
      if (prototype) {
         $.extend(child.prototype, prototype);
      }
   }

   var SUBST = [['', ''], // spec
   ['exit', 'cancel'], // firefox & old webkits expect cancelFullScreen instead of exitFullscreen
   ['screen', 'Screen'] // firefox expects FullScreen instead of Fullscreen
   ];

   var VENDOR_PREFIXES = ['', 'o', 'ms', 'moz', 'webkit', 'webkitCurrent'];

   function native(obj, name) {
      var prefixed;

      if (typeof obj === 'string') {
         name = obj;
         obj = document;
      }

      for (var i = 0; i < SUBST.length; ++i) {
         name = name.replace(SUBST[i][0], SUBST[i][1]);
         for (var j = 0; j < VENDOR_PREFIXES.length; ++j) {
            prefixed = VENDOR_PREFIXES[j];
            prefixed += j === 0 ? name : name.charAt(0).toUpperCase() + name.substr(1);
            if (defined(obj[prefixed])) {
               return obj[prefixed];
            }
         }
      }

      return void 0;
   }var ua = navigator.userAgent;
   var fsEnabled = native('fullscreenEnabled');
   var IS_ANDROID_CHROME = ua.indexOf('Android') !== -1 && ua.indexOf('Chrome') !== -1;
   var IS_NATIVELY_SUPPORTED = !IS_ANDROID_CHROME && defined(native('fullscreenElement')) && (!defined(fsEnabled) || fsEnabled === true);

   var version = $.fn.jquery.split('.');
   var JQ_LT_17 = parseInt(version[0]) < 2 && parseInt(version[1]) < 7;

   var FullScreenAbstract = function FullScreenAbstract() {
      this.__options = null;
      this._fullScreenElement = null;
      this.__savedStyles = {};
   };

   FullScreenAbstract.prototype = {
      _DEFAULT_OPTIONS: {
         styles: {
            'boxSizing': 'border-box',
            'MozBoxSizing': 'border-box',
            'WebkitBoxSizing': 'border-box'
         },
         toggleClass: null
      },
      __documentOverflow: 'visible',
      __htmlOverflow: 'visible',
      _preventDocumentScroll: function _preventDocumentScroll() {
         // Disabled ability
         this.__documentOverflow = $('body')[0].style.overflow;
         this.__htmlOverflow = $('html')[0].style.overflow;
      },
      _allowDocumentScroll: function _allowDocumentScroll() {
         $('body')[0].style.overflow = this.__documentOverflow;
         $('html')[0].style.overflow = this.__htmlOverflow;
      },
      _fullScreenChange: function _fullScreenChange() {
         if (!this.__options) return; // only process fullscreenchange events caused by this plugin
         if (!this.isFullScreen()) {
            this._allowDocumentScroll();
            this._revertStyles();
            this._triggerEvents();
            this._fullScreenElement = null;
         } else {
            this._preventDocumentScroll();
            this._triggerEvents();
         }
      },
      _fullScreenError: function _fullScreenError(e) {
         if (!this.__options) return; // only process fullscreenchange events caused by this plugin
         this._revertStyles();
         this._fullScreenElement = null;
         if (e) {
            $(document).trigger('fscreenerror', [e]);
         }
      },
      _triggerEvents: function _triggerEvents() {
         $(this._fullScreenElement).trigger(this.isFullScreen() ? 'fscreenopen' : 'fscreenclose');
         $(document).trigger('fscreenchange', [this.isFullScreen(), this._fullScreenElement]);
      },
      _saveAndApplyStyles: function _saveAndApplyStyles() {
         var $elem = $(this._fullScreenElement);
         this.__savedStyles = {};
         for (var property in this.__options.styles) {
            // save
            this.__savedStyles[property] = this._fullScreenElement.style[property];
            // apply
            this._fullScreenElement.style[property] = this.__options.styles[property];
         }
         if (this.__options.toggleClass) {
            $elem.addClass(this.__options.toggleClass);
         }
      },
      _revertStyles: function _revertStyles() {
         var $elem = $(this._fullScreenElement);
         for (var property in this.__options.styles) {
            this._fullScreenElement.style[property] = this.__savedStyles[property];
         }
         if (this.__options.toggleClass) {
            $elem.removeClass(this.__options.toggleClass);
         }
      },
      open: function open(elem, options) {
         // do nothing if request is for already fullscreened element
         if (elem === this._fullScreenElement) {
            return;
         }
         // exit active fullscreen before opening another one
         if (this.isFullScreen()) {
            this.exit();
         }
         // save fullscreened element
         this._fullScreenElement = elem;
         // apply options, if any
         this.__options = $.extend(true, {}, this._DEFAULT_OPTIONS, options);
         // save current element styles and apply new
         this._saveAndApplyStyles();
      },
      exit: null,
      isFullScreen: null,
      isNativelySupported: function isNativelySupported() {
         return IS_NATIVELY_SUPPORTED;
      }
   };
   var FullScreenNative = function FullScreenNative() {
      FullScreenNative._super.constructor.apply(this, arguments);
      this.exit = $.proxy(native('exitFullscreen'), document);
      this._DEFAULT_OPTIONS = $.extend(true, {}, this._DEFAULT_OPTIONS, {
         'styles': {
            'width': '100%',
            'height': '100%'
         }
      });
      $(document).bind(this._prefixedString('fullscreenchange') + ' MSFullscreenChange', $.proxy(this._fullScreenChange, this)).bind(this._prefixedString('fullscreenerror') + ' MSFullscreenError', $.proxy(this._fullScreenError, this));
   };

   extend(FullScreenNative, FullScreenAbstract, {
      VENDOR_PREFIXES: ['', 'o', 'moz', 'webkit'],
      _prefixedString: function _prefixedString(str) {
         return $.map(this.VENDOR_PREFIXES, function (s) {
            return s + str;
         }).join(' ');
      },
      open: function open(elem, options) {
         FullScreenNative._super.open.apply(this, arguments);
         var requestFS = native(elem, 'requestFullscreen');
         requestFS.call(elem);
      },
      exit: $.noop,
      isFullScreen: function isFullScreen() {
         return native('fullscreenElement') !== null;
      },
      element: function element() {
         return native('fullscreenElement');
      }
   });
   var FullScreenFallback = function FullScreenFallback() {
      FullScreenFallback._super.constructor.apply(this, arguments);
      this._DEFAULT_OPTIONS = $.extend({}, this._DEFAULT_OPTIONS, {
         'styles': {
            'position': 'fixed',
            'zIndex': '2147483647',
            'left': 0,
            'top': 0,
            'bottom': 0,
            'right': 0
         }
      });
      this.__delegateKeydownHandler();
   };

   extend(FullScreenFallback, FullScreenAbstract, {
      __isFullScreen: false,
      __delegateKeydownHandler: function __delegateKeydownHandler() {
         var $doc = $(document);
         $doc.delegate('*', 'keydown.fullscreen', $.proxy(this.__keydownHandler, this));
         var data = JQ_LT_17 ? $doc.data('events') : $._data(document).events;
         var events = data['keydown'];
         if (!JQ_LT_17) {
            events.splice(0, 0, events.splice(events.delegateCount - 1, 1)[0]);
         } else {
            data.live.unshift(data.live.pop());
         }
      },
      __keydownHandler: function __keydownHandler(e) {
         if (this.isFullScreen() && e.which === 27) {
            this.exit();
            return false;
         }
         return true;
      },
      _revertStyles: function _revertStyles() {
         FullScreenFallback._super._revertStyles.apply(this, arguments);
         // force redraw (fixes bug in IE7 with content dissapearing)
         this._fullScreenElement.offsetHeight;
      },
      open: function open(elem) {
         FullScreenFallback._super.open.apply(this, arguments);
         this.__isFullScreen = true;
         this._fullScreenChange();
      },
      exit: function exit() {
         this.__isFullScreen = false;
         this._fullScreenChange();
      },
      isFullScreen: function isFullScreen() {
         return this.__isFullScreen;
      },
      element: function element() {
         return this.__isFullScreen ? this._fullScreenElement : null;
      }
   });$.fullscreen = IS_NATIVELY_SUPPORTED ? new FullScreenNative() : new FullScreenFallback();

   $.fn.fullscreen = function (options) {
      var elem = this[0];

      options = $.extend({
         toggleClass: null,
         overflow: 'hidden'
      }, options);
      options.styles = {
         overflow: options.overflow
      };
      delete options.overflow;

      if (elem) {
         $.fullscreen.open(elem, options);
      }

      return this;
   };
})(jQuery);

/*!
 * hoverIntent v1.8.0 - Copyright 2014 Brian Cherne
 * http://cherne.net/brian/resources/jquery.hoverIntent.html
 * You are free to use hoverIntent as long as this header is left intact.
 */
;
(function ($) {
   $.fn.hoverIntent = function (handlerIn, handlerOut, selector) {
      var cfg = { interval: 100, sensitivity: 6, timeout: 0 };if ((typeof handlerIn === "undefined" ? "undefined" : _typeof(handlerIn)) === "object") {
         cfg = $.extend(cfg, handlerIn);
      } else {
         if ($.isFunction(handlerOut)) {
            cfg = $.extend(cfg, { over: handlerIn, out: handlerOut, selector: selector });
         } else {
            cfg = $.extend(cfg, { over: handlerIn, out: handlerIn, selector: handlerOut });
         }
      }var cX, cY, pX, pY;var track = function track(ev) {
         cX = ev.pageX;cY = ev.pageY;
      };var compare = function compare(ev, ob) {
         ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);if (Math.sqrt((pX - cX) * (pX - cX) + (pY - cY) * (pY - cY)) < cfg.sensitivity) {
            $(ob).off("mousemove.hoverIntent", track);ob.hoverIntent_s = true;return cfg.over.apply(ob, [ev]);
         } else {
            pX = cX;pY = cY;ob.hoverIntent_t = setTimeout(function () {
               compare(ev, ob);
            }, cfg.interval);
         }
      };var delay = function delay(ev, ob) {
         ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);ob.hoverIntent_s = false;return cfg.out.apply(ob, [ev]);
      };var handleHover = function handleHover(e) {
         var ev = $.extend({}, e);var ob = this;if (ob.hoverIntent_t) {
            ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
         }if (e.type === "mouseenter") {
            pX = ev.pageX;pY = ev.pageY;$(ob).on("mousemove.hoverIntent", track);if (!ob.hoverIntent_s) {
               ob.hoverIntent_t = setTimeout(function () {
                  compare(ev, ob);
               }, cfg.interval);
            }
         } else {
            $(ob).off("mousemove.hoverIntent", track);if (ob.hoverIntent_s) {
               ob.hoverIntent_t = setTimeout(function () {
                  delay(ev, ob);
               }, cfg.timeout);
            }
         }
      };return this.on({ "mouseenter.hoverIntent": handleHover, "mouseleave.hoverIntent": handleHover }, cfg.selector);
   };
})(jQuery);

/*! Copyright (c) 2011 Brandon Aaron (http://brandonaaron.net)
 * Licensed under the MIT License (LICENSE.txt).
 * Version: 3.0.6
 */
;
!function (a) {
   function d(b) {
      var c = b || window.event,
          d = [].slice.call(arguments, 1),
          e = 0,
          g = 0,
          h = 0;return b = a.event.fix(c), b.type = "mousewheel", c.wheelDelta && (e = c.wheelDelta / 120), c.detail && (e = -c.detail / 3), h = e, void 0 !== c.axis && c.axis === c.HORIZONTAL_AXIS && (h = 0, g = -1 * e), void 0 !== c.wheelDeltaY && (h = c.wheelDeltaY / 120), void 0 !== c.wheelDeltaX && (g = -1 * c.wheelDeltaX / 120), d.unshift(b, e, g, h), (a.event.dispatch || a.event.handle).apply(this, d);
   }var b = ["DOMMouseScroll", "mousewheel"];if (a.event.fixHooks) for (var c = b.length; c;) {
      a.event.fixHooks[b[--c]] = a.event.mouseHooks;
   }a.event.special.mousewheel = { setup: function setup() {
         if (this.addEventListener) for (var a = b.length; a;) {
            this.addEventListener(b[--a], d, !1);
         } else this.onmousewheel = d;
      }, teardown: function teardown() {
         if (this.removeEventListener) for (var a = b.length; a;) {
            this.removeEventListener(b[--a], d, !1);
         } else this.onmousewheel = null;
      } }, a.fn.extend({ mousewheel: function mousewheel(a) {
         return a ? this.bind("mousewheel", a) : this.trigger("mousewheel");
      }, unmousewheel: function unmousewheel(a) {
         return this.unbind("mousewheel", a);
      } });
}(jQuery);

/*!
 * jQuery Smooth Scroll - v1.5.4 - 2014-11-17
 * https://github.com/kswedberg/jquery-smooth-scroll
 * Copyright (c) 2014 Karl Swedberg
 * Licensed MIT (https://github.com/kswedberg/jquery-smooth-scroll/blob/master/LICENSE-MIT)
 */
;
(function (t) {
    true ? !(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(0)], __WEBPACK_AMD_DEFINE_FACTORY__ = (t),
				__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
				(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__)) : t(jQuery);
})(function (t) {
   function e(t) {
      return t.replace(/(:|\.|\/)/g, "\\$1");
   }var l = "1.5.4",
       o = {},
       n = { exclude: [], excludeWithin: [], offset: 0, direction: "top", scrollElement: null, scrollTarget: null, beforeScroll: function beforeScroll() {}, afterScroll: function afterScroll() {}, easing: "swing", speed: 400, autoCoefficient: 2, preventDefault: !0 },
       s = function s(e) {
      var l = [],
          o = !1,
          n = e.dir && "left" === e.dir ? "scrollLeft" : "scrollTop";return this.each(function () {
         if (this !== document && this !== window) {
            var e = t(this);e[n]() > 0 ? l.push(this) : (e[n](1), o = e[n]() > 0, o && l.push(this), e[n](0));
         }
      }), l.length || this.each(function () {
         "BODY" === this.nodeName && (l = [this]);
      }), "first" === e.el && l.length > 1 && (l = [l[0]]), l;
   };t.fn.extend({ scrollable: function scrollable(t) {
         var e = s.call(this, { dir: t });return this.pushStack(e);
      }, firstScrollable: function firstScrollable(t) {
         var e = s.call(this, { el: "first", dir: t });return this.pushStack(e);
      }, smoothScroll: function smoothScroll(l, o) {
         if (l = l || {}, "options" === l) return o ? this.each(function () {
            var e = t(this),
                l = t.extend(e.data("ssOpts") || {}, o);t(this).data("ssOpts", l);
         }) : this.first().data("ssOpts");var n = t.extend({}, t.fn.smoothScroll.defaults, l),
             s = t.smoothScroll.filterPath(location.pathname);return this.unbind("click.smoothscroll").bind("click.smoothscroll", function (l) {
            var o = this,
                r = t(this),
                i = t.extend({}, n, r.data("ssOpts") || {}),
                c = n.exclude,
                a = i.excludeWithin,
                f = 0,
                h = 0,
                u = !0,
                d = {},
                p = location.hostname === o.hostname || !o.hostname,
                m = i.scrollTarget || t.smoothScroll.filterPath(o.pathname) === s,
                S = e(o.hash);if (i.scrollTarget || p && m && S) {
               for (; u && c.length > f;) {
                  r.is(e(c[f++])) && (u = !1);
               }for (; u && a.length > h;) {
                  r.closest(a[h++]).length && (u = !1);
               }
            } else u = !1;u && (i.preventDefault && l.preventDefault(), t.extend(d, i, { scrollTarget: i.scrollTarget || S, link: o }), t.smoothScroll(d));
         }), this;
      } }), t.smoothScroll = function (e, l) {
      if ("options" === e && "object" == (typeof l === "undefined" ? "undefined" : _typeof(l))) return t.extend(o, l);var n,
          s,
          r,
          i,
          c,
          a = 0,
          f = "offset",
          h = "scrollTop",
          u = {},
          d = {};"number" == typeof e ? (n = t.extend({ link: null }, t.fn.smoothScroll.defaults, o), r = e) : (n = t.extend({ link: null }, t.fn.smoothScroll.defaults, e || {}, o), n.scrollElement && (f = "position", "static" === n.scrollElement.css("position") && n.scrollElement.css("position", "relative"))), h = "left" === n.direction ? "scrollLeft" : h, n.scrollElement ? (s = n.scrollElement, /^(?:HTML|BODY)$/.test(s[0].nodeName) || (a = s[h]())) : s = t("html, body").firstScrollable(n.direction), n.beforeScroll.call(s, n), r = "number" == typeof e ? e : l || t(n.scrollTarget)[f]() && t(n.scrollTarget)[f]()[n.direction] || 0, u[h] = r + a + n.offset, i = n.speed, "auto" === i && (c = u[h] - s.scrollTop(), 0 > c && (c *= -1), i = c / n.autoCoefficient), d = { duration: i, easing: n.easing, complete: function complete() {
            n.afterScroll.call(n.link, n);
         } }, n.step && (d.step = n.step), s.length ? s.stop().animate(u, d) : n.afterScroll.call(n.link, n);
   }, t.smoothScroll.version = l, t.smoothScroll.filterPath = function (t) {
      return t = t || "", t.replace(/^\//, "").replace(/(?:index|default).[a-zA-Z]{3,4}$/, "").replace(/\/$/, "");
   }, t.fn.smoothScroll.defaults = n;
});

/*
 * jQuery UI Touch Punch 0.2.3
 */
;
!function (a) {
   function f(a, b) {
      if (!(a.originalEvent.touches.length > 1)) {
         a.preventDefault();var c = a.originalEvent.changedTouches[0],
             d = document.createEvent("MouseEvents");d.initMouseEvent(b, !0, !0, window, 1, c.screenX, c.screenY, c.clientX, c.clientY, !1, !1, !1, !1, 0, null), a.target.dispatchEvent(d);
      }
   }if (a.support.touch = "ontouchend" in document, a.support.touch) {
      var e,
          b = a.ui.mouse.prototype,
          c = b._mouseInit,
          d = b._mouseDestroy;b._touchStart = function (a) {
         var b = this;!e && b._mouseCapture(a.originalEvent.changedTouches[0]) && (e = !0, b._touchMoved = !1, f(a, "mouseover"), f(a, "mousemove"), f(a, "mousedown"));
      }, b._touchMove = function (a) {
         e && (this._touchMoved = !0, f(a, "mousemove"));
      }, b._touchEnd = function (a) {
         e && (f(a, "mouseup"), f(a, "mouseout"), this._touchMoved || f(a, "click"), e = !1);
      }, b._mouseInit = function () {
         var b = this;b.element.bind({ touchstart: a.proxy(b, "_touchStart"), touchmove: a.proxy(b, "_touchMove"), touchend: a.proxy(b, "_touchEnd") }), c.call(b);
      }, b._mouseDestroy = function () {
         var b = this;b.element.unbind({ touchstart: a.proxy(b, "_touchStart"), touchmove: a.proxy(b, "_touchMove"), touchend: a.proxy(b, "_touchEnd") }), d.call(b);
      };
   }
}(jQuery);

/*
 * https://github.com/douglascrockford/JSON-js/blob/master/json2.js
 */
;
var JSON;if (!JSON) {
   JSON = {};
}(function () {
   function f(a) {
      return a < 10 ? "0" + a : a;
   }function quote(a) {
      escapable.lastIndex = 0;return escapable.test(a) ? '"' + a.replace(escapable, function (a) {
         var b = meta[a];return typeof b === "string" ? b : "\\u" + ("0000" + a.charCodeAt(0).toString(16)).slice(-4);
      }) + '"' : '"' + a + '"';
   }function str(a, b) {
      var c,
          d,
          e,
          f,
          g = gap,
          h,
          i = b[a];if (i && (typeof i === "undefined" ? "undefined" : _typeof(i)) === "object" && typeof i.toJSON === "function") {
         i = i.toJSON(a);
      }if (typeof rep === "function") {
         i = rep.call(b, a, i);
      }switch (typeof i === "undefined" ? "undefined" : _typeof(i)) {case "string":
            return quote(i);case "number":
            return isFinite(i) ? String(i) : "null";case "boolean":case "null":
            return String(i);case "object":
            if (!i) {
               return "null";
            }gap += indent;h = [];if (Object.prototype.toString.apply(i) === "[object Array]") {
               f = i.length;for (c = 0; c < f; c += 1) {
                  h[c] = str(c, i) || "null";
               }e = h.length === 0 ? "[]" : gap ? "[\n" + gap + h.join(",\n" + gap) + "\n" + g + "]" : "[" + h.join(",") + "]";gap = g;return e;
            }if (rep && (typeof rep === "undefined" ? "undefined" : _typeof(rep)) === "object") {
               f = rep.length;for (c = 0; c < f; c += 1) {
                  if (typeof rep[c] === "string") {
                     d = rep[c];e = str(d, i);if (e) {
                        h.push(quote(d) + (gap ? ": " : ":") + e);
                     }
                  }
               }
            } else {
               for (d in i) {
                  if (Object.prototype.hasOwnProperty.call(i, d)) {
                     e = str(d, i);if (e) {
                        h.push(quote(d) + (gap ? ": " : ":") + e);
                     }
                  }
               }
            }e = h.length === 0 ? "{}" : gap ? "{\n" + gap + h.join(",\n" + gap) + "\n" + g + "}" : "{" + h.join(",") + "}";gap = g;return e;}
   }"use strict";if (typeof Date.prototype.toJSON !== "function") {
      Date.prototype.toJSON = function (a) {
         return isFinite(this.valueOf()) ? this.getUTCFullYear() + "-" + f(this.getUTCMonth() + 1) + "-" + f(this.getUTCDate()) + "T" + f(this.getUTCHours()) + ":" + f(this.getUTCMinutes()) + ":" + f(this.getUTCSeconds()) + "Z" : null;
      };String.prototype.toJSON = Number.prototype.toJSON = Boolean.prototype.toJSON = function (a) {
         return this.valueOf();
      };
   }var cx = /[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,
       escapable = /[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,
       gap,
       indent,
       meta = { "\b": "\\b", " ": "\\t", "\n": "\\n", "\f": "\\f", "\r": "\\r", '"': '\\"', "\\": "\\\\" },
       rep;if (typeof JSON.stringify !== "function") {
      JSON.stringify = function (a, b, c) {
         var d;gap = "";indent = "";if (typeof c === "number") {
            for (d = 0; d < c; d += 1) {
               indent += " ";
            }
         } else if (typeof c === "string") {
            indent = c;
         }rep = b;if (b && typeof b !== "function" && ((typeof b === "undefined" ? "undefined" : _typeof(b)) !== "object" || typeof b.length !== "number")) {
            throw new Error("JSON.stringify");
         }return str("", { "": a });
      };
   }if (typeof JSON.parse !== "function") {
      JSON.parse = function (text, reviver) {
         function walk(a, b) {
            var c,
                d,
                e = a[b];if (e && (typeof e === "undefined" ? "undefined" : _typeof(e)) === "object") {
               for (c in e) {
                  if (Object.prototype.hasOwnProperty.call(e, c)) {
                     d = walk(e, c);if (d !== undefined) {
                        e[c] = d;
                     } else {
                        delete e[c];
                     }
                  }
               }
            }return reviver.call(a, b, e);
         }var j;text = String(text);cx.lastIndex = 0;if (cx.test(text)) {
            text = text.replace(cx, function (a) {
               return "\\u" + ("0000" + a.charCodeAt(0).toString(16)).slice(-4);
            });
         }if (/^[\],:{}\s]*$/.test(text.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, "@").replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, "]").replace(/(?:^|:|,)(?:\s*\[)+/g, ""))) {
            j = eval("(" + text + ")");return typeof reviver === "function" ? walk({ "": j }, "") : j;
         }throw new SyntaxError("JSON.parse");
      };
   }
})();

/*!
 * Scroll Lock v1.1.1
 * https://github.com/MohammadYounes/jquery-scrollLock
 *
 */
;
!function (a) {
    true ? !(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(0)], __WEBPACK_AMD_DEFINE_FACTORY__ = (a),
				__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
				(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__)) : a(jQuery);
}(function (a) {
   function e(a) {
      var b = a.prop("clientWidth"),
          c = a.prop("offsetWidth"),
          d = parseInt(a.css("border-right-width"), 10),
          e = parseInt(a.css("border-left-width"), 10);return c > b + e + d;
   }var b = "onmousewheel" in window ? "ActiveXObject" in window ? "wheel" : "mousewheel" : "DOMMouseScroll",
       c = ".scrollLock",
       d = a.fn.scrollLock;a.fn.scrollLock = function (d, f, g) {
      return "string" != typeof f && (f = null), void 0 !== d && !d || "off" === d ? this.each(function () {
         a(this).off(c);
      }) : this.each(function () {
         a(this).on(b + c, f, function (b) {
            if (!b.ctrlKey) {
               var c = a(this);if (g === !0 || e(c)) {
                  b.stopPropagation();var d = c.scrollTop(),
                      f = c.prop("scrollHeight"),
                      h = c.prop("clientHeight"),
                      i = b.originalEvent.wheelDelta || -1 * b.originalEvent.detail || -1 * b.originalEvent.deltaY,
                      j = 0;if ("wheel" === b.type) {
                     var k = c.height() / a(window).height();j = b.originalEvent.deltaY * k;
                  }(i > 0 && 0 >= d + j || 0 > i && d + j >= f - h) && (b.preventDefault(), j && c.scrollTop(d + j));
               }
            }
         });
      });
   }, a.fn.scrollLock.noConflict = function () {
      return a.fn.scrollLock = d, this;
   };
});

;
!function ($) {

   "use strict"; // jshint ;_;

   if (typeof ko !== 'undefined' && ko.bindingHandlers && !ko.bindingHandlers.multiselect) {
      ko.bindingHandlers.multiselect = {

         init: function init(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {

            var listOfSelectedItems = allBindingsAccessor().selectedOptions;
            var config = ko.utils.unwrapObservable(valueAccessor());

            $(element).multiselect(config);

            if (isObservableArray(listOfSelectedItems)) {

               // Set the initial selection state on the multiselect list.
               $(element).multiselect('select', ko.utils.unwrapObservable(listOfSelectedItems));

               // Subscribe to the selectedOptions: ko.observableArray
               listOfSelectedItems.subscribe(function (changes) {
                  var addedArray = [],
                      deletedArray = [];
                  forEach(changes, function (change) {
                     switch (change.status) {
                        case 'added':
                           addedArray.push(change.value);
                           break;
                        case 'deleted':
                           deletedArray.push(change.value);
                           break;
                     }
                  });

                  if (addedArray.length > 0) {
                     $(element).multiselect('select', addedArray);
                  }

                  if (deletedArray.length > 0) {
                     $(element).multiselect('deselect', deletedArray);
                  }
               }, null, "arrayChange");
            }
         },

         update: function update(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {

            var listOfItems = allBindingsAccessor().options,
                ms = $(element).data('multiselect'),
                config = ko.utils.unwrapObservable(valueAccessor());

            if (isObservableArray(listOfItems)) {
               // Subscribe to the options: ko.observableArray incase it changes later
               listOfItems.subscribe(function (theArray) {
                  $(element).multiselect('rebuild');
               });
            }

            if (!ms) {
               $(element).multiselect(config);
            } else {
               ms.updateOriginalOptions();
            }
         }
      };
   }

   function isObservableArray(obj) {
      return ko.isObservable(obj) && !(obj.destroyAll === undefined);
   }

   function forEach(array, callback) {
      for (var index = 0; index < array.length; ++index) {
         callback(array[index]);
      }
   }

   /**
    * Constructor to create a new multiselect using the given select.
    *
    * @param {jQuery} select
    * @param {Object} options
    * @returns {Multiselect}
    */
   function Multiselect(select, options) {

      this.$select = $(select);
      this.options = this.mergeOptions($.extend({}, options, this.$select.data()));

      // Initialization.
      // We have to clone to create a new reference.
      this.originalOptions = this.$select.clone()[0].options;
      this.query = '';
      this.searchTimeout = null;

      this.options.multiple = this.$select.attr('multiple') === "multiple";
      this.options.onChange = $.proxy(this.options.onChange, this);
      this.options.onDropdownShow = $.proxy(this.options.onDropdownShow, this);
      this.options.onDropdownHide = $.proxy(this.options.onDropdownHide, this);
      this.options.onDropdownShown = $.proxy(this.options.onDropdownShown, this);
      this.options.onDropdownHidden = $.proxy(this.options.onDropdownHidden, this);

      // Build select all if enabled.
      this.buildContainer();
      this.buildButton();
      this.buildDropdown();
      this.buildSelectAll();
      this.buildDropdownOptions();
      this.buildFilter();

      this.updateButtonText();
      this.updateSelectAll();

      if (this.options.disableIfEmpty && $('option', this.$select).length <= 0) {
         this.disable();
      }

      this.$select.hide().after(this.$container);
   };

   Multiselect.prototype = {

      defaults: {
         /**
          * Default text function will either print 'None selected' in case no
          * option is selected or a list of the selected options up to a length
          * of 3 selected options.
          *
          * @param {jQuery} options
          * @param {jQuery} select
          * @returns {String}
          */
         buttonText: function buttonText(options, select) {
            if (options.length === 0) {
               return this.nonSelectedText + ' <b class="caret"></b>';
            } else if (options.length == $('option', $(select)).length) {
               return this.allSelectedText + ' <b class="caret"></b>';
            } else if (options.length > this.numberDisplayed) {
               return options.length + ' ' + this.nSelectedText + ' <b class="caret"></b>';
            } else {
               var selected = '';
               options.each(function () {
                  var label = $(this).attr('label') !== undefined ? $(this).attr('label') : $(this).html();

                  selected += label + ', ';
               });

               return selected.substr(0, selected.length - 2) + ' <b class="caret"></b>';
            }
         },
         /**
          * Updates the title of the button similar to the buttonText function.
          *
          * @param {jQuery} options
          * @param {jQuery} select
          * @returns {@exp;selected@call;substr}
          */
         buttonTitle: function buttonTitle(options, select) {
            if (options.length === 0) {
               return this.nonSelectedText;
            } else {
               var selected = '';
               options.each(function () {
                  selected += $(this).text() + ', ';
               });
               return selected.substr(0, selected.length - 2);
            }
         },
         /**
          * Create a label.
          *
          * @param {jQuery} element
          * @returns {String}
          */
         label: function label(element) {
            return $(element).attr('label') || $(element).html();
         },
         /**
          * Triggered on change of the multiselect.
          *
          * Not triggered when selecting/deselecting options manually.
          *
          * @param {jQuery} option
          * @param {Boolean} checked
          */
         onChange: function onChange(option, checked) {},
         /**
          * Triggered when the dropdown is shown.
          *
          * @param {jQuery} event
          */
         onDropdownShow: function onDropdownShow(event) {},
         /**
          * Triggered when the dropdown is hidden.
          *
          * @param {jQuery} event
          */
         onDropdownHide: function onDropdownHide(event) {},
         /**
          * Triggered after the dropdown is shown.
          *
          * @param {jQuery} event
          */
         onDropdownShown: function onDropdownShown(event) {},
         /**
          * Triggered after the dropdown is hidden.
          *
          * @param {jQuery} event
          */
         onDropdownHidden: function onDropdownHidden(event) {},
         buttonClass: 'btn btn-default',
         buttonWidth: 'auto',
         buttonContainer: '<div class="btn-group" />',
         dropRight: false,
         selectedClass: 'active',
         // Maximum height of the dropdown menu.
         // If maximum height is exceeded a scrollbar will be displayed.
         maxHeight: false,
         checkboxName: false,
         includeSelectAllOption: false,
         includeSelectAllIfMoreThan: 0,
         selectAllText: ' Select all',
         selectAllValue: 'multiselect-all',
         selectAllName: false,
         enableFiltering: false,
         enableCaseInsensitiveFiltering: false,
         enableClickableOptGroups: false,
         filterPlaceholder: 'Search',
         // possible options: 'text', 'value', 'both'
         filterBehavior: 'text',
         includeFilterClearBtn: true,
         preventInputChangeEvent: false,
         nonSelectedText: 'None selected',
         nSelectedText: 'selected',
         allSelectedText: 'All selected',
         numberDisplayed: 3,
         disableIfEmpty: false,
         templates: {
            button: '<button type="button" class="multiselect dropdown-toggle" data-toggle="dropdown"></button>',
            ul: '<ul class="multiselect-container dropdown-menu"></ul>',
            filter: '<li class="multiselect-item filter"><div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span><input class="form-control multiselect-search" type="text"></div></li>',
            filterClearBtn: '<span class="input-group-btn"><button class="btn btn-default multiselect-clear-filter" type="button"><i class="glyphicon glyphicon-remove"></i></button></span>',
            li: '<li><a href="javascript:void(0);"><label></label></a></li>',
            divider: '<li class="multiselect-item divider"></li>',
            liGroup: '<li class="multiselect-item multiselect-group"><label></label></li>'
         }
      },

      constructor: Multiselect,

      /**
       * Builds the container of the multiselect.
       */
      buildContainer: function buildContainer() {
         this.$container = $(this.options.buttonContainer);
         this.$container.on('show.bs.dropdown', this.options.onDropdownShow);
         this.$container.on('hide.bs.dropdown', this.options.onDropdownHide);
         this.$container.on('shown.bs.dropdown', this.options.onDropdownShown);
         this.$container.on('hidden.bs.dropdown', this.options.onDropdownHidden);
      },

      /**
       * Builds the button of the multiselect.
       */
      buildButton: function buildButton() {
         this.$button = $(this.options.templates.button).addClass(this.options.buttonClass);

         // Adopt active state.
         if (this.$select.prop('disabled')) {
            this.disable();
         } else {
            this.enable();
         }

         // Manually add button width if set.
         if (this.options.buttonWidth && this.options.buttonWidth !== 'auto') {
            this.$button.css({
               'width': this.options.buttonWidth
            });
            this.$container.css({
               'width': this.options.buttonWidth
            });
         }

         // Keep the tab index from the select.
         var tabindex = this.$select.attr('tabindex');
         if (tabindex) {
            this.$button.attr('tabindex', tabindex);
         }

         this.$container.prepend(this.$button);
      },

      /**
       * Builds the ul representing the dropdown menu.
       */
      buildDropdown: function buildDropdown() {

         // Build ul.
         this.$ul = $(this.options.templates.ul);

         if (this.options.dropRight) {
            this.$ul.addClass('pull-right');
         }

         // Set max height of dropdown menu to activate auto scrollbar.
         if (this.options.maxHeight) {
            // TODO: Add a class for this option to move the css declarations.
            this.$ul.css({
               'max-height': this.options.maxHeight + 'px',
               'overflow-y': 'auto',
               'overflow-x': 'hidden'
            });
         }

         this.$container.append(this.$ul);
      },

      /**
       * Build the dropdown options and binds all nessecary events.
       *
       * Uses createDivider and createOptionValue to create the necessary options.
       */
      buildDropdownOptions: function buildDropdownOptions() {

         this.$select.children().each($.proxy(function (index, element) {

            var $element = $(element);
            // Support optgroups and options without a group simultaneously.
            var tag = $element.prop('tagName').toLowerCase();

            if ($element.prop('value') === this.options.selectAllValue) {
               return;
            }

            if (tag === 'optgroup') {
               this.createOptgroup(element);
            } else if (tag === 'option') {

               if ($element.data('role') === 'divider') {
                  this.createDivider();
               } else {
                  this.createOptionValue(element);
               }
            }

            // Other illegal tags will be ignored.
         }, this));

         // Bind the change event on the dropdown elements.
         $('li input', this.$ul).on('change', $.proxy(function (event) {
            var $target = $(event.target);

            var checked = $target.prop('checked') || false;
            var isSelectAllOption = $target.val() === this.options.selectAllValue;

            // Apply or unapply the configured selected class.
            if (this.options.selectedClass) {
               if (checked) {
                  $target.closest('li').addClass(this.options.selectedClass);
               } else {
                  $target.closest('li').removeClass(this.options.selectedClass);
               }
            }

            // Get the corresponding option.
            var value = $target.val();
            var $option = this.getOptionByValue(value);

            var $optionsNotThis = $('option', this.$select).not($option);
            var $checkboxesNotThis = $('input', this.$container).not($target);

            if (isSelectAllOption) {
               if (checked) {
                  this.selectAll();
               } else {
                  this.deselectAll();
               }
            }

            if (!isSelectAllOption) {
               if (checked) {
                  $option.prop('selected', true);

                  if (this.options.multiple) {
                     // Simply select additional option.
                     $option.prop('selected', true);
                  } else {
                     // Unselect all other options and corresponding checkboxes.
                     if (this.options.selectedClass) {
                        $($checkboxesNotThis).closest('li').removeClass(this.options.selectedClass);
                     }

                     $($checkboxesNotThis).prop('checked', false);
                     $optionsNotThis.prop('selected', false);

                     // It's a single selection, so close.
                     this.$button.click();
                  }

                  if (this.options.selectedClass === "active") {
                     $optionsNotThis.closest("a").css("outline", "");
                  }
               } else {
                  // Unselect option.
                  $option.prop('selected', false);
               }
            }

            this.$select.change();

            this.updateButtonText();
            this.updateSelectAll();

            this.options.onChange($option, checked);

            if (this.options.preventInputChangeEvent) {
               return false;
            }
         }, this));

         $('li a', this.$ul).on('touchstart click', function (event) {
            event.stopPropagation();

            var $target = $(event.target);

            if (document.getSelection().type === 'Range') {
               var $input = $(this).find("input:first");

               $input.prop("checked", !$input.prop("checked")).trigger("change");
            }

            if (event.shiftKey) {
               var checked = $target.prop('checked') || false;

               if (checked) {
                  var prev = $target.closest('li').siblings('li[class="active"]:first');

                  var currentIdx = $target.closest('li').index();
                  var prevIdx = prev.index();

                  if (currentIdx > prevIdx) {
                     $target.closest("li").prevUntil(prev).each(function () {
                        $(this).find("input:first").prop("checked", true).trigger("change");
                     });
                  } else {
                     $target.closest("li").nextUntil(prev).each(function () {
                        $(this).find("input:first").prop("checked", true).trigger("change");
                     });
                  }
               }
            }

            $target.blur();
         });

         // Keyboard support.
         this.$container.off('keydown.multiselect').on('keydown.multiselect', $.proxy(function (event) {
            if ($('input[type="text"]', this.$container).is(':focus')) {
               return;
            }

            if (event.keyCode === 9 && this.$container.hasClass('open')) {
               this.$button.click();
            } else {
               var $items = $(this.$container).find("li:not(.divider):not(.disabled) a").filter(":visible");

               if (!$items.length) {
                  return;
               }

               var index = $items.index($items.filter(':focus'));

               // Navigation up.
               if (event.keyCode === 38 && index > 0) {
                  index--;
               }
               // Navigate down.
               else if (event.keyCode === 40 && index < $items.length - 1) {
                     index++;
                  } else if (!~index) {
                     index = 0;
                  }

               var $current = $items.eq(index);
               $current.focus();

               if (event.keyCode === 32 || event.keyCode === 13) {
                  var $checkbox = $current.find('input');

                  $checkbox.prop("checked", !$checkbox.prop("checked"));
                  $checkbox.change();
               }

               event.stopPropagation();
               event.preventDefault();
            }
         }, this));

         if (this.options.enableClickableOptGroups && this.options.multiple) {
            $('li.multiselect-group', this.$ul).on('click', $.proxy(function (event) {
               event.stopPropagation();

               var group = $(event.target).parent();

               // Search all option in optgroup
               var $options = group.nextUntil('li.multiselect-group');

               // check or uncheck items
               var allChecked = true;
               var optionInputs = $options.find('input');
               optionInputs.each(function () {
                  allChecked = allChecked && $(this).prop('checked');
               });

               optionInputs.prop('checked', !allChecked).trigger('change');
            }, this));
         }
      },

      /**
       * Create an option using the given select option.
       *
       * @param {jQuery} element
       */
      createOptionValue: function createOptionValue(element) {
         var $element = $(element);
         if ($element.is(':selected')) {
            $element.prop('selected', true);
         }

         // Support the label attribute on options.
         var label = this.options.label(element);
         var value = $element.val();
         var inputType = this.options.multiple ? "checkbox" : "radio";

         var $li = $(this.options.templates.li);
         var $label = $('label', $li);
         $label.addClass(inputType);

         var $checkbox = $('<input/>').attr('type', inputType);

         if (this.options.checkboxName) {
            $checkbox.attr('name', this.options.checkboxName);
         }
         $label.append($checkbox);

         var selected = $element.prop('selected') || false;
         $checkbox.val(value);

         if (value === this.options.selectAllValue) {
            $li.addClass("multiselect-item multiselect-all");
            $checkbox.parent().parent().addClass('multiselect-all');
         }

         $label.append(" " + label);
         $label.attr('title', $element.attr('title'));

         this.$ul.append($li);

         if ($element.is(':disabled')) {
            $checkbox.attr('disabled', 'disabled').prop('disabled', true).closest('a').attr("tabindex", "-1").closest('li').addClass('disabled');
         }

         $checkbox.prop('checked', selected);

         if (selected && this.options.selectedClass) {
            $checkbox.closest('li').addClass(this.options.selectedClass);
         }
      },

      /**
       * Creates a divider using the given select option.
       *
       * @param {jQuery} element
       */
      createDivider: function createDivider(element) {
         var $divider = $(this.options.templates.divider);
         this.$ul.append($divider);
      },

      /**
       * Creates an optgroup.
       *
       * @param {jQuery} group
       */
      createOptgroup: function createOptgroup(group) {
         var groupName = $(group).prop('label');

         // Add a header for the group.
         var $li = $(this.options.templates.liGroup);
         $('label', $li).text(groupName);

         if (this.options.enableClickableOptGroups) {
            $li.addClass('multiselect-group-clickable');
         }

         this.$ul.append($li);

         if ($(group).is(':disabled')) {
            $li.addClass('disabled');
         }

         // Add the options of the group.
         $('option', group).each($.proxy(function (index, element) {
            this.createOptionValue(element);
         }, this));
      },

      /**
       * Build the selct all.
       *
       * Checks if a select all has already been created.
       */
      buildSelectAll: function buildSelectAll() {
         if (typeof this.options.selectAllValue === 'number') {
            this.options.selectAllValue = this.options.selectAllValue.toString();
         }

         var alreadyHasSelectAll = this.hasSelectAll();

         if (!alreadyHasSelectAll && this.options.includeSelectAllOption && this.options.multiple && $('option', this.$select).length > this.options.includeSelectAllIfMoreThan) {

            // Check whether to add a divider after the select all.
            if (this.options.includeSelectAllDivider) {
               this.$ul.prepend($(this.options.templates.divider));
            }

            var $li = $(this.options.templates.li);
            $('label', $li).addClass("checkbox");

            if (this.options.selectAllName) {
               $('label', $li).append('<input type="checkbox" name="' + this.options.selectAllName + '" />');
            } else {
               $('label', $li).append('<input type="checkbox" />');
            }

            var $checkbox = $('input', $li);
            $checkbox.val(this.options.selectAllValue);

            $li.addClass("multiselect-item multiselect-all");
            $checkbox.parent().parent().addClass('multiselect-all');

            $('label', $li).append(" " + this.options.selectAllText);

            this.$ul.prepend($li);

            $checkbox.prop('checked', false);
         }
      },

      /**
       * Builds the filter.
       */
      buildFilter: function buildFilter() {

         // Build filter if filtering OR case insensitive filtering is enabled and the number of options exceeds (or equals) enableFilterLength.
         if (this.options.enableFiltering || this.options.enableCaseInsensitiveFiltering) {
            var enableFilterLength = Math.max(this.options.enableFiltering, this.options.enableCaseInsensitiveFiltering);

            if (this.$select.find('option').length >= enableFilterLength) {

               this.$filter = $(this.options.templates.filter);
               $('input', this.$filter).attr('placeholder', this.options.filterPlaceholder);

               // Adds optional filter clear button
               if (this.options.includeFilterClearBtn) {
                  var clearBtn = $(this.options.templates.filterClearBtn);
                  clearBtn.on('click', $.proxy(function (event) {
                     clearTimeout(this.searchTimeout);
                     this.$filter.find('.multiselect-search').val('');
                     $('li', this.$ul).show().removeClass("filter-hidden");
                     this.updateSelectAll();
                  }, this));
                  this.$filter.find('.input-group').append(clearBtn);
               }

               this.$ul.prepend(this.$filter);

               this.$filter.val(this.query).on('click', function (event) {
                  event.stopPropagation();
               }).on('input keydown', $.proxy(function (event) {
                  // Cancel enter key default behaviour
                  if (event.which === 13) {
                     event.preventDefault();
                  }

                  // This is useful to catch "keydown" events after the browser has updated the control.
                  clearTimeout(this.searchTimeout);

                  this.searchTimeout = this.asyncFunction($.proxy(function () {

                     if (this.query !== event.target.value) {
                        this.query = event.target.value;

                        var currentGroup, currentGroupVisible;
                        $.each($('li', this.$ul), $.proxy(function (index, element) {
                           var value = $('input', element).val();
                           var text = $('label', element).text();

                           var filterCandidate = '';
                           if (this.options.filterBehavior === 'text') {
                              filterCandidate = text;
                           } else if (this.options.filterBehavior === 'value') {
                              filterCandidate = value;
                           } else if (this.options.filterBehavior === 'both') {
                              filterCandidate = text + '\n' + value;
                           }

                           if (value !== this.options.selectAllValue && text) {
                              // By default lets assume that element is not
                              // interesting for this search.
                              var showElement = false;

                              if (this.options.enableCaseInsensitiveFiltering && filterCandidate.toLowerCase().indexOf(this.query.toLowerCase()) > -1) {
                                 showElement = true;
                              } else if (filterCandidate.indexOf(this.query) > -1) {
                                 showElement = true;
                              }

                              // Toggle current element (group or group item) according to showElement boolean.
                              $(element).toggle(showElement).toggleClass('filter-hidden', !showElement);

                              // Differentiate groups and group items.
                              if ($(element).hasClass('multiselect-group')) {
                                 // Remember group status.
                                 currentGroup = element;
                                 currentGroupVisible = showElement;
                              } else {
                                 // Show group name when at least one of its items is visible.
                                 if (showElement) {
                                    $(currentGroup).show().removeClass('filter-hidden');
                                 }

                                 // Show all group items when group name satisfies filter.
                                 if (!showElement && currentGroupVisible) {
                                    $(element).show().removeClass('filter-hidden');
                                 }
                              }
                           }
                        }, this));
                     }

                     this.updateSelectAll();
                  }, this), 300, this);
               }, this));
            }
         }
      },

      /**
       * Unbinds the whole plugin.
       */
      destroy: function destroy() {
         this.$container.remove();
         this.$select.show();
         this.$select.data('multiselect', null);
      },

      /**
       * Refreshs the multiselect based on the selected options of the select.
       */
      refresh: function refresh() {
         $('option', this.$select).each($.proxy(function (index, element) {
            var $input = $('li input', this.$ul).filter(function () {
               return $(this).val() === $(element).val();
            });

            if ($(element).is(':selected')) {
               $input.prop('checked', true);

               if (this.options.selectedClass) {
                  $input.closest('li').addClass(this.options.selectedClass);
               }
            } else {
               $input.prop('checked', false);

               if (this.options.selectedClass) {
                  $input.closest('li').removeClass(this.options.selectedClass);
               }
            }

            if ($(element).is(":disabled")) {
               $input.attr('disabled', 'disabled').prop('disabled', true).closest('li').addClass('disabled');
            } else {
               $input.prop('disabled', false).closest('li').removeClass('disabled');
            }
         }, this));

         this.updateButtonText();
         this.updateSelectAll();
      },

      /**
       * Select all options of the given values.
       *
       * If triggerOnChange is set to true, the on change event is triggered if
       * and only if one value is passed.
       *
       * @param {Array} selectValues
       * @param {Boolean} triggerOnChange
       */
      select: function select(selectValues, triggerOnChange) {
         if (!$.isArray(selectValues)) {
            selectValues = [selectValues];
         }

         for (var i = 0; i < selectValues.length; i++) {
            var value = selectValues[i];

            if (value === null || value === undefined) {
               continue;
            }

            var $option = this.getOptionByValue(value);
            var $checkbox = this.getInputByValue(value);

            if ($option === undefined || $checkbox === undefined) {
               continue;
            }

            if (!this.options.multiple) {
               this.deselectAll(false);
            }

            if (this.options.selectedClass) {
               $checkbox.closest('li').addClass(this.options.selectedClass);
            }

            $checkbox.prop('checked', true);
            $option.prop('selected', true);
         }

         this.updateButtonText();
         this.updateSelectAll();

         if (triggerOnChange && selectValues.length === 1) {
            this.options.onChange($option, true);
         }
      },

      /**
       * Clears all selected items.
       */
      clearSelection: function clearSelection() {
         this.deselectAll(false);
         this.updateButtonText();
         this.updateSelectAll();
      },

      /**
       * Deselects all options of the given values.
       *
       * If triggerOnChange is set to true, the on change event is triggered, if
       * and only if one value is passed.
       *
       * @param {Array} deselectValues
       * @param {Boolean} triggerOnChange
       */
      deselect: function deselect(deselectValues, triggerOnChange) {
         if (!$.isArray(deselectValues)) {
            deselectValues = [deselectValues];
         }

         for (var i = 0; i < deselectValues.length; i++) {
            var value = deselectValues[i];

            if (value === null || value === undefined) {
               continue;
            }

            var $option = this.getOptionByValue(value);
            var $checkbox = this.getInputByValue(value);

            if ($option === undefined || $checkbox === undefined) {
               continue;
            }

            if (this.options.selectedClass) {
               $checkbox.closest('li').removeClass(this.options.selectedClass);
            }

            $checkbox.prop('checked', false);
            $option.prop('selected', false);
         }

         this.updateButtonText();
         this.updateSelectAll();

         if (triggerOnChange && deselectValues.length === 1) {
            this.options.onChange($option, false);
         }
      },

      /**
       * Selects all enabled & visible options.
       *
       * If justVisible is true or not specified, only visible options are selected.
       *
       * @param {Boolean} justVisible
       */
      selectAll: function selectAll(justVisible) {
         var justVisible = typeof justVisible === 'undefined' ? true : justVisible;
         var allCheckboxes = $("li input[type='checkbox']:enabled", this.$ul);
         var visibleCheckboxes = allCheckboxes.filter(":visible");
         var allCheckboxesCount = allCheckboxes.length;
         var visibleCheckboxesCount = visibleCheckboxes.length;

         if (justVisible) {
            visibleCheckboxes.prop('checked', true);
            $("li:not(.divider):not(.disabled)", this.$ul).filter(":visible").addClass(this.options.selectedClass);
         } else {
            allCheckboxes.prop('checked', true);
            $("li:not(.divider):not(.disabled)", this.$ul).addClass(this.options.selectedClass);
         }

         if (allCheckboxesCount === visibleCheckboxesCount || justVisible === false) {
            $("option:enabled", this.$select).prop('selected', true);
         } else {
            var values = visibleCheckboxes.map(function () {
               return $(this).val();
            }).get();

            $("option:enabled", this.$select).filter(function (index) {
               return $.inArray($(this).val(), values) !== -1;
            }).prop('selected', true);
         }
      },

      /**
       * Deselects all options.
       *
       * If justVisible is true or not specified, only visible options are deselected.
       *
       * @param {Boolean} justVisible
       */
      deselectAll: function deselectAll(justVisible) {
         var justVisible = typeof justVisible === 'undefined' ? true : justVisible;

         if (justVisible) {
            var visibleCheckboxes = $("li input[type='checkbox']:enabled", this.$ul).filter(":visible");
            visibleCheckboxes.prop('checked', false);

            var values = visibleCheckboxes.map(function () {
               return $(this).val();
            }).get();

            $("option:enabled", this.$select).filter(function (index) {
               return $.inArray($(this).val(), values) !== -1;
            }).prop('selected', false);

            if (this.options.selectedClass) {
               $("li:not(.divider):not(.disabled)", this.$ul).filter(":visible").removeClass(this.options.selectedClass);
            }
         } else {
            $("li input[type='checkbox']:enabled", this.$ul).prop('checked', false);
            $("option:enabled", this.$select).prop('selected', false);

            if (this.options.selectedClass) {
               $("li:not(.divider):not(.disabled)", this.$ul).removeClass(this.options.selectedClass);
            }
         }
      },

      /**
       * Rebuild the plugin.
       *
       * Rebuilds the dropdown, the filter and the select all option.
       */
      rebuild: function rebuild() {
         this.$ul.html('');

         // Important to distinguish between radios and checkboxes.
         this.options.multiple = this.$select.attr('multiple') === "multiple";

         this.buildSelectAll();
         this.buildDropdownOptions();
         this.buildFilter();

         this.updateButtonText();
         this.updateSelectAll();

         if (this.options.disableIfEmpty && $('option', this.$select).length <= 0) {
            this.disable();
         }

         if (this.options.dropRight) {
            this.$ul.addClass('pull-right');
         }
      },

      /**
       * The provided data will be used to build the dropdown.
       */
      dataprovider: function dataprovider(_dataprovider) {
         var optionDOM = "";
         var groupCounter = 0;
         var tags = $(''); // create empty jQuery array

         $.each(_dataprovider, function (index, option) {
            var tag;
            if ($.isArray(option.children)) {
               // create optiongroup tag
               groupCounter++;
               tag = $('<optgroup/>').attr({
                  label: option.label || 'Group ' + groupCounter
               });
               forEach(option.children, function (subOption) {
                  // add children option tags
                  tag.append($('<option/>').attr({
                     value: subOption.value,
                     label: subOption.label || subOption.value,
                     title: subOption.title,
                     selected: !!subOption.selected
                  }));
               });

               optionDOM += '</optgroup>';
            } else {
               // create option tag
               tag = $('<option/>').attr({
                  value: option.value,
                  label: option.label || option.value,
                  title: option.title,
                  selected: !!option.selected
               });
            }

            tags = tags.add(tag);
         });

         this.$select.empty().append(tags);
         this.rebuild();
      },

      /**
       * Enable the multiselect.
       */
      enable: function enable() {
         this.$select.prop('disabled', false);
         this.$button.prop('disabled', false).removeClass('disabled');
      },

      /**
       * Disable the multiselect.
       */
      disable: function disable() {
         this.$select.prop('disabled', true);
         this.$button.prop('disabled', true).addClass('disabled');
      },

      /**
       * Set the options.
       *
       * @param {Array} options
       */
      setOptions: function setOptions(options) {
         this.options = this.mergeOptions(options);
      },

      /**
       * Merges the given options with the default options.
       *
       * @param {Array} options
       * @returns {Array}
       */
      mergeOptions: function mergeOptions(options) {
         return $.extend(true, {}, this.defaults, options);
      },

      /**
       * Checks whether a select all checkbox is present.
       *
       * @returns {Boolean}
       */
      hasSelectAll: function hasSelectAll() {
         return $('li.' + this.options.selectAllValue, this.$ul).length > 0;
      },

      /**
       * Updates the select all checkbox based on the currently displayed and selected checkboxes.
       */
      updateSelectAll: function updateSelectAll() {
         if (this.hasSelectAll()) {
            var allBoxes = $("li:not(.multiselect-item):not(.filter-hidden) input:enabled", this.$ul);
            var allBoxesLength = allBoxes.length;
            var checkedBoxesLength = allBoxes.filter(":checked").length;
            var selectAllLi = $("li." + this.options.selectAllValue, this.$ul);
            var selectAllInput = selectAllLi.find("input");

            if (checkedBoxesLength > 0 && checkedBoxesLength === allBoxesLength) {
               selectAllInput.prop("checked", true);
               selectAllLi.addClass(this.options.selectedClass);
            } else {
               selectAllInput.prop("checked", false);
               selectAllLi.removeClass(this.options.selectedClass);
            }
         }
      },

      /**
       * Update the button text and its title based on the currently selected options.
       */
      updateButtonText: function updateButtonText() {
         var options = this.getSelected();

         // First update the displayed button text.
         $('.multiselect', this.$container).html(this.options.buttonText(options, this.$select));

         // Now update the title attribute of the button.
         $('.multiselect', this.$container).attr('title', this.options.buttonTitle(options, this.$select));
      },

      /**
       * Get all selected options.
       *
       * @returns {jQUery}
       */
      getSelected: function getSelected() {
         return $('option', this.$select).filter(":selected");
      },

      /**
       * Gets a select option by its value.
       *
       * @param {String} value
       * @returns {jQuery}
       */
      getOptionByValue: function getOptionByValue(value) {

         var options = $('option', this.$select);
         var valueToCompare = value.toString();

         for (var i = 0; i < options.length; i = i + 1) {
            var option = options[i];
            if (option.value === valueToCompare) {
               return $(option);
            }
         }
      },

      /**
       * Get the input (radio/checkbox) by its value.
       *
       * @param {String} value
       * @returns {jQuery}
       */
      getInputByValue: function getInputByValue(value) {

         var checkboxes = $('li input', this.$ul);
         var valueToCompare = value.toString();

         for (var i = 0; i < checkboxes.length; i = i + 1) {
            var checkbox = checkboxes[i];
            if (checkbox.value === valueToCompare) {
               return $(checkbox);
            }
         }
      },

      /**
       * Used for knockout integration.
       */
      updateOriginalOptions: function updateOriginalOptions() {
         this.originalOptions = this.$select.clone()[0].options;
      },

      asyncFunction: function asyncFunction(callback, timeout, self) {
         var args = Array.prototype.slice.call(arguments, 3);
         return setTimeout(function () {
            callback.apply(self || window, args);
         }, timeout);
      }
   };

   $.fn.multiselect = function (option, parameter, extraOptions) {
      return this.each(function () {
         var data = $(this).data('multiselect');
         var options = (typeof option === "undefined" ? "undefined" : _typeof(option)) === 'object' && option;

         // Initialize the multiselect.
         if (!data) {
            data = new Multiselect(this, options);
            $(this).data('multiselect', data);
         }

         // Call multiselect method.
         if (typeof option === 'string') {
            data[option](parameter, extraOptions);

            if (option === 'destroy') {
               $(this).data('multiselect', false);
            }
         }
      });
   };

   $.fn.multiselect.Constructor = Multiselect;

   $(function () {
      $("select[data-role=multiselect]").multiselect();
   });
}(__webpack_provided_window_dot_jQuery);

;

!function (a) {
   return  true ? !(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(0)], __WEBPACK_AMD_DEFINE_RESULT__ = function (b) {
      return a(b, window, document);
   }.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__)) : a(jQuery, window, document);
}(function (a, b, c) {
   "use strict";
   var d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s, t, u, v, w, x, y, z, A, B, C, D, E, F, G, H;z = { paneClass: "nano-pane", sliderClass: "nano-slider", contentClass: "nano-content", iOSNativeScrolling: !1, preventPageScrolling: !1, disableResize: !1, alwaysVisible: !1, flashDelay: 1500, sliderMinHeight: 20, sliderMaxHeight: null, documentContext: null, windowContext: null }, u = "scrollbar", t = "scroll", l = "mousedown", m = "mouseenter", n = "mousemove", p = "mousewheel", o = "mouseup", s = "resize", h = "drag", i = "enter", w = "up", r = "panedown", f = "DOMMouseScroll", g = "down", x = "wheel", j = "keydown", k = "keyup", v = "touchmove", d = "Microsoft Internet Explorer" === b.navigator.appName && /msie 7./i.test(b.navigator.appVersion) && b.ActiveXObject, e = null, D = b.requestAnimationFrame, y = b.cancelAnimationFrame, F = c.createElement("div").style, H = function () {
      var a, b, c, d, e, f;for (d = ["t", "webkitT", "MozT", "msT", "OT"], a = e = 0, f = d.length; f > e; a = ++e) {
         if (c = d[a], b = d[a] + "ransform", b in F) return d[a].substr(0, d[a].length - 1);
      }return !1;
   }(), G = function G(a) {
      return H === !1 ? !1 : "" === H ? a : H + a.charAt(0).toUpperCase() + a.substr(1);
   }, E = G("transform"), B = E !== !1, A = function A() {
      var a, b, d;return a = c.createElement("div"), b = a.style, b.position = "absolute", b.width = "100px", b.height = "100px", b.overflow = t, b.top = "-9999px", c.body.appendChild(a), d = a.offsetWidth - a.clientWidth, c.body.removeChild(a), d;
   }, C = function C() {
      var a, c, d;return c = b.navigator.userAgent, (a = /(?=.+Mac OS X)(?=.+Firefox)/.test(c)) ? (d = /Firefox\/\d{2}\./.exec(c), d && (d = d[0].replace(/\D+/g, "")), a && +d > 23) : !1;
   }, q = function () {
      function j(d, f) {
         this.el = d, this.options = f, e || (e = A()), this.$el = a(this.el), this.doc = a(this.options.documentContext || c), this.win = a(this.options.windowContext || b), this.body = this.doc.find("body"), this.$content = this.$el.children("." + f.contentClass), this.$content.attr("tabindex", this.options.tabIndex || 0), this.content = this.$content[0], this.previousPosition = 0, this.options.iOSNativeScrolling && null != this.el.style.WebkitOverflowScrolling ? this.nativeScrolling() : this.generate(), this.createEvents(), this.addEvents(), this.reset();
      }return j.prototype.preventScrolling = function (a, b) {
         if (this.isActive) if (a.type === f) (b === g && a.originalEvent.detail > 0 || b === w && a.originalEvent.detail < 0) && a.preventDefault();else if (a.type === p) {
            if (!a.originalEvent || !a.originalEvent.wheelDelta) return;(b === g && a.originalEvent.wheelDelta < 0 || b === w && a.originalEvent.wheelDelta > 0) && a.preventDefault();
         }
      }, j.prototype.nativeScrolling = function () {
         this.$content.css({ WebkitOverflowScrolling: "touch" }), this.iOSNativeScrolling = !0, this.isActive = !0;
      }, j.prototype.updateScrollValues = function () {
         var a, b;a = this.content, this.maxScrollTop = a.scrollHeight - a.clientHeight, this.prevScrollTop = this.contentScrollTop || 0, this.contentScrollTop = a.scrollTop, b = this.contentScrollTop > this.previousPosition ? "down" : this.contentScrollTop < this.previousPosition ? "up" : "same", this.previousPosition = this.contentScrollTop, "same" !== b && this.$el.trigger("update", { position: this.contentScrollTop, maximum: this.maxScrollTop, direction: b }), this.iOSNativeScrolling || (this.maxSliderTop = this.paneHeight - this.sliderHeight, this.sliderTop = 0 === this.maxScrollTop ? 0 : this.contentScrollTop * this.maxSliderTop / this.maxScrollTop);
      }, j.prototype.setOnScrollStyles = function () {
         var a;B ? (a = {}, a[E] = "translate(0, " + this.sliderTop + "px)") : a = { top: this.sliderTop }, D ? (y && this.scrollRAF && y(this.scrollRAF), this.scrollRAF = D(function (b) {
            return function () {
               return b.scrollRAF = null, b.slider.css(a);
            };
         }(this))) : this.slider.css(a);
      }, j.prototype.createEvents = function () {
         this.events = { down: function (a) {
               return function (b) {
                  return a.isBeingDragged = !0, a.offsetY = b.pageY - a.slider.offset().top, a.slider.is(b.target) || (a.offsetY = 0), a.pane.addClass("active"), a.doc.bind(n, a.events[h]).bind(o, a.events[w]), a.body.bind(m, a.events[i]), !1;
               };
            }(this), drag: function (a) {
               return function (b) {
                  return a.sliderY = b.pageY - a.$el.offset().top - a.paneTop - (a.offsetY || .5 * a.sliderHeight), a.scroll(), a.contentScrollTop >= a.maxScrollTop && a.prevScrollTop !== a.maxScrollTop ? a.$el.trigger("scrollend") : 0 === a.contentScrollTop && 0 !== a.prevScrollTop && a.$el.trigger("scrolltop"), !1;
               };
            }(this), up: function (a) {
               return function () {
                  return a.isBeingDragged = !1, a.pane.removeClass("active"), a.doc.unbind(n, a.events[h]).unbind(o, a.events[w]), a.body.unbind(m, a.events[i]), !1;
               };
            }(this), resize: function (a) {
               return function () {
                  a.reset();
               };
            }(this), panedown: function (a) {
               return function (b) {
                  return a.sliderY = (b.offsetY || b.originalEvent.layerY) - .5 * a.sliderHeight, a.scroll(), a.events.down(b), !1;
               };
            }(this), scroll: function (a) {
               return function (b) {
                  a.updateScrollValues(), a.isBeingDragged || (a.iOSNativeScrolling || (a.sliderY = a.sliderTop, a.setOnScrollStyles()), null != b && (a.contentScrollTop >= a.maxScrollTop ? (a.options.preventPageScrolling && a.preventScrolling(b, g), a.prevScrollTop !== a.maxScrollTop && a.$el.trigger("scrollend")) : 0 === a.contentScrollTop && (a.options.preventPageScrolling && a.preventScrolling(b, w), 0 !== a.prevScrollTop && a.$el.trigger("scrolltop"))));
               };
            }(this), wheel: function (a) {
               return function (b) {
                  var c;if (null != b) return c = b.delta || b.wheelDelta || b.originalEvent && b.originalEvent.wheelDelta || -b.detail || b.originalEvent && -b.originalEvent.detail, c && (a.sliderY += -c / 3), a.scroll(), !1;
               };
            }(this), enter: function (a) {
               return function (b) {
                  var c;if (a.isBeingDragged) return 1 !== (b.buttons || b.which) ? (c = a.events)[w].apply(c, arguments) : void 0;
               };
            }(this) };
      }, j.prototype.addEvents = function () {
         var a;this.removeEvents(), a = this.events, this.options.disableResize || this.win.bind(s, a[s]), this.iOSNativeScrolling || (this.slider.bind(l, a[g]), this.pane.bind(l, a[r]).bind("" + p + " " + f, a[x])), this.$content.bind("" + t + " " + p + " " + f + " " + v, a[t]);
      }, j.prototype.removeEvents = function () {
         var a;a = this.events, this.win.unbind(s, a[s]), this.iOSNativeScrolling || (this.slider.unbind(), this.pane.unbind()), this.$content.unbind("" + t + " " + p + " " + f + " " + v, a[t]);
      }, j.prototype.generate = function () {
         var a, c, d, f, g, h, i;return f = this.options, h = f.paneClass, i = f.sliderClass, a = f.contentClass, (g = this.$el.children("." + h)).length || g.children("." + i).length || this.$el.append('<div class="' + h + '"><div class="' + i + '" /></div>'), this.pane = this.$el.children("." + h), this.slider = this.pane.find("." + i), 0 === e && C() ? (d = b.getComputedStyle(this.content, null).getPropertyValue("padding-right").replace(/[^0-9.]+/g, ""), c = { right: -14, paddingRight: +d + 14 }) : e && (c = { right: -e }, this.$el.addClass("has-scrollbar")), null != c && this.$content.css(c), this;
      }, j.prototype.restore = function () {
         this.stopped = !1, this.iOSNativeScrolling || this.pane.show(), this.addEvents();
      }, j.prototype.reset = function () {
         var a, b, c, f, g, h, i, j, k, l, m, n;return this.iOSNativeScrolling ? void (this.contentHeight = this.content.scrollHeight) : (this.$el.find("." + this.options.paneClass).length || this.generate().stop(), this.stopped && this.restore(), a = this.content, f = a.style, g = f.overflowY, d && this.$content.css({ height: this.$content.height() }), b = a.scrollHeight + e, l = parseInt(this.$el.css("max-height"), 10), l > 0 && (this.$el.height(""), this.$el.height(a.scrollHeight > l ? l : a.scrollHeight)), i = this.pane.outerHeight(!1), k = parseInt(this.pane.css("top"), 10), h = parseInt(this.pane.css("bottom"), 10), j = i + k + h, n = Math.round(j / b * j), n < this.options.sliderMinHeight ? n = this.options.sliderMinHeight : null != this.options.sliderMaxHeight && n > this.options.sliderMaxHeight && (n = this.options.sliderMaxHeight), g === t && f.overflowX !== t && (n += e), this.maxSliderTop = j - n, this.contentHeight = b, this.paneHeight = i, this.paneOuterHeight = j, this.sliderHeight = n, this.paneTop = k, this.slider.height(n), this.events.scroll(), this.pane.show(), this.isActive = !0, a.scrollHeight === a.clientHeight || this.pane.outerHeight(!0) >= a.scrollHeight && g !== t ? (this.pane.hide(), this.isActive = !1) : this.el.clientHeight === a.scrollHeight && g === t ? this.slider.hide() : this.slider.show(), this.pane.css({ opacity: this.options.alwaysVisible ? 1 : "", visibility: this.options.alwaysVisible ? "visible" : "" }), c = this.$content.css("position"), ("static" === c || "relative" === c) && (m = parseInt(this.$content.css("right"), 10), m && this.$content.css({ right: "", marginRight: m })), this);
      }, j.prototype.scroll = function () {
         return this.isActive ? (this.sliderY = Math.max(0, this.sliderY), this.sliderY = Math.min(this.maxSliderTop, this.sliderY), this.$content.scrollTop(this.maxScrollTop * this.sliderY / this.maxSliderTop), this.iOSNativeScrolling || (this.updateScrollValues(), this.setOnScrollStyles()), this) : void 0;
      }, j.prototype.scrollBottom = function (a) {
         return this.isActive ? (this.$content.scrollTop(this.contentHeight - this.$content.height() - a).trigger(p), this.stop().restore(), this) : void 0;
      }, j.prototype.scrollTop = function (a) {
         return this.isActive ? (this.$content.scrollTop(+a).trigger(p), this.stop().restore(), this) : void 0;
      }, j.prototype.scrollTo = function (a) {
         return this.isActive ? (this.scrollTop(this.$el.find(a).get(0).offsetTop), this) : void 0;
      }, j.prototype.stop = function () {
         return y && this.scrollRAF && (y(this.scrollRAF), this.scrollRAF = null), this.stopped = !0, this.removeEvents(), this.iOSNativeScrolling || this.pane.hide(), this;
      }, j.prototype.destroy = function () {
         return this.stopped || this.stop(), !this.iOSNativeScrolling && this.pane.length && this.pane.remove(), d && this.$content.height(""), this.$content.removeAttr("tabindex"), this.$el.hasClass("has-scrollbar") && (this.$el.removeClass("has-scrollbar"), this.$content.css({ right: "" })), this;
      }, j.prototype.flash = function () {
         return !this.iOSNativeScrolling && this.isActive ? (this.reset(), this.pane.addClass("flashed"), setTimeout(function (a) {
            return function () {
               a.pane.removeClass("flashed");
            };
         }(this), this.options.flashDelay), this) : void 0;
      }, j;
   }(), a.fn.nanoScroller = function (b) {
      return this.each(function () {
         var c, d;if ((d = this.nanoscroller) || (c = a.extend({}, z, b), this.nanoscroller = d = new q(this, c)), b && "object" == (typeof b === "undefined" ? "undefined" : _typeof(b))) {
            if (a.extend(d.options, b), null != b.scrollBottom) return d.scrollBottom(b.scrollBottom);if (null != b.scrollTop) return d.scrollTop(b.scrollTop);if (b.scrollTo) return d.scrollTo(b.scrollTo);if ("bottom" === b.scroll) return d.scrollBottom(0);if ("top" === b.scroll) return d.scrollTop(0);if (b.scroll && b.scroll instanceof a) return d.scrollTo(b.scroll);if (b.stop) return d.stop();if (b.destroy) return d.destroy();if (b.flash) return d.flash();
         }return d.reset();
      });
   }, a.fn.nanoScroller.Constructor = q;
});

;(function ($, window) {
   "use strict";

   var namespace = "scroller",
       $body = null,
       classes = {
      base: "scroller",
      content: "scroller-content",
      bar: "scroller-bar",
      track: "scroller-track",
      handle: "scroller-handle",
      isHorizontal: "scroller-horizontal",
      isSetup: "scroller-setup",
      isActive: "scroller-active"
   },
       events = {
      start: "touchstart." + namespace + " mousedown." + namespace,
      move: "touchmove." + namespace + " mousemove." + namespace,
      end: "touchend." + namespace + " mouseup." + namespace
   };

   /**
    * @options
    * @param customClass [string] <''> "Class applied to instance"
    * @param duration [int] <0> "Scroll animation length"
    * @param handleSize [int] <0> "Handle size; 0 to auto size"
    * @param horizontal [boolean] <false> "Scroll horizontally"
    * @param trackMargin [int] <0> "Margin between track and handle edge”
    */
   var options = {
      customClass: "",
      duration: 0,
      handleSize: 0,
      horizontal: false,
      trackMargin: 0
   };

   var pub = {

      /**
       * @method
       * @name defaults
       * @description Sets default plugin options
       * @param opts [object] <{}> "Options object"
       * @example $.scroller("defaults", opts);
       */
      defaults: function defaults(opts) {
         options = $.extend(options, opts || {});
         return _typeof(this) === 'object' ? $(this) : true;
      },

      /**
       * @method
       * @name destroy
       * @description Removes instance of plugin
       * @example $(".target").scroller("destroy");
       */
      destroy: function destroy() {
         return $(this).each(function (i, el) {
            var data = $(el).data(namespace);

            if (data) {
               data.$scroller.removeClass([data.customClass, classes.base, classes.isActive].join(" "));

               data.$bar.remove();
               data.$content.contents().unwrap();

               data.$content.off(classify(namespace));
               data.$scroller.off(classify(namespace)).removeData(namespace);
            }
         });
      },

      /**
       * @method
       * @name scroll
       * @description Scrolls instance of plugin to element or position
       * @param pos [string || int] <null> "Target element selector or static position"
       * @param duration [int] <null> "Optional scroll duration"
       * @example $.scroller("scroll", pos, duration);
       */
      scroll: function scroll(pos, dur) {
         return $(this).each(function (i) {
            var data = $(this).data(namespace),
                duration = dur || options.duration;

            if (typeof pos !== "number") {
               var $el = $(pos);
               if ($el.length > 0) {
                  var offset = $el.position();
                  if (data.horizontal) {
                     pos = offset.left + data.$content.scrollLeft();
                  } else {
                     pos = offset.top + data.$content.scrollTop();
                  }
               } else {
                  pos = data.$content.scrollTop();
               }
            }

            var styles = data.horizontal ? { scrollLeft: pos } : { scrollTop: pos };

            data.$content.stop().animate(styles, duration);
         });
      },

      /**
       * @method
       * @name reset
       * @description Resets layout on instance of plugin
       * @example $.scroller("reset");
       */
      reset: function reset() {
         return $(this).each(function (i) {
            var data = $(this).data(namespace);

            if (data) {
               data.$scroller.addClass(classes.isSetup);

               var barStyles = {},
                   trackStyles = {},
                   handleStyles = {},
                   handlePosition = 0,
                   isActive = true;

               if (data.horizontal) {
                  // Horizontal
                  data.barHeight = data.$content[0].offsetHeight - data.$content[0].clientHeight;
                  data.frameWidth = data.$content.outerWidth();
                  data.trackWidth = data.frameWidth - data.trackMargin * 2;
                  data.scrollWidth = data.$content[0].scrollWidth;
                  data.ratio = data.trackWidth / data.scrollWidth;
                  data.trackRatio = data.trackWidth / data.scrollWidth;
                  data.handleWidth = data.handleSize > 0 ? data.handleSize : data.trackWidth * data.trackRatio;
                  data.scrollRatio = (data.scrollWidth - data.frameWidth) / (data.trackWidth - data.handleWidth);
                  data.handleBounds = {
                     left: 0,
                     right: data.trackWidth - data.handleWidth
                  };

                  data.$content.css({
                     paddingBottom: data.barHeight + data.paddingBottom
                  });

                  var scrollLeft = data.$content.scrollLeft();

                  handlePosition = scrollLeft * data.ratio;
                  isActive = data.scrollWidth <= data.frameWidth;

                  barStyles = {
                     width: data.frameWidth
                  };

                  trackStyles = {
                     width: data.trackWidth,
                     marginLeft: data.trackMargin,
                     marginRight: data.trackMargin
                  };

                  handleStyles = {
                     width: data.handleWidth
                  };
               } else {
                  // Vertical
                  data.barWidth = data.$content[0].offsetWidth - data.$content[0].clientWidth;
                  data.frameHeight = data.$content.outerHeight();
                  data.trackHeight = data.frameHeight - data.trackMargin * 2;
                  data.scrollHeight = data.$content[0].scrollHeight;
                  data.ratio = data.trackHeight / data.scrollHeight;
                  data.trackRatio = data.trackHeight / data.scrollHeight;
                  data.handleHeight = data.handleSize > 0 ? data.handleSize : data.trackHeight * data.trackRatio;
                  data.scrollRatio = (data.scrollHeight - data.frameHeight) / (data.trackHeight - data.handleHeight);
                  data.handleBounds = {
                     top: 0,
                     bottom: data.trackHeight - data.handleHeight
                  };

                  var scrollTop = data.$content.scrollTop();

                  handlePosition = scrollTop * data.ratio;
                  isActive = data.scrollHeight <= data.frameHeight;

                  barStyles = {
                     height: data.frameHeight
                  };

                  trackStyles = {
                     height: data.trackHeight,
                     marginBottom: data.trackMargin,
                     marginTop: data.trackMargin
                  };

                  handleStyles = {
                     height: data.handleHeight
                  };
               }

               // Updates

               if (isActive) {
                  data.$scroller.removeClass(classes.isActive);
               } else {
                  data.$scroller.addClass(classes.isActive);
               }

               data.$bar.css(barStyles);
               data.$track.css(trackStyles);
               data.$handle.css(handleStyles);

               position(data, handlePosition);

               data.$scroller.removeClass(classes.isSetup);
            }
         });
      }
   };

   /**
    * @method private
    * @name init
    * @description Initializes plugin
    * @param opts [object] "Initialization options"
    */
   function init(opts) {
      // Local options
      opts = $.extend({}, options, opts || {});

      // Check for Body
      if ($body === null) {
         $body = $("body");
      }

      // Apply to each element
      var $items = $(this);
      for (var i = 0, count = $items.length; i < count; i++) {
         build($items.eq(i), opts);
      }
      return $items;
   }

   /**
    * @method private
    * @name build
    * @description Builds each instance
    * @param $scroller [jQuery object] "Target jQuery object"
    * @param opts [object] <{}> "Options object"
    */
   function build($scroller, opts) {
      if (!$scroller.hasClass(classes.base)) {
         // EXTEND OPTIONS
         opts = $.extend({}, opts, $scroller.data(namespace + "-options"));

         var html = '';

         html += '<div class="' + classes.bar + '">';
         html += '<div class="' + classes.track + '">';
         html += '<div class="' + classes.handle + '">';
         html += '</div></div></div>';

         opts.paddingRight = parseInt($scroller.css("padding-right"), 10);
         opts.paddingBottom = parseInt($scroller.css("padding-bottom"), 10);

         $scroller.addClass([classes.base, opts.customClass].join(" ")).wrapInner('<div class="' + classes.content + '" />').prepend(html);

         if (opts.horizontal) {
            $scroller.addClass(classes.isHorizontal);
         }

         var data = $.extend({
            $scroller: $scroller,
            $content: $scroller.find(classify(classes.content)),
            $bar: $scroller.find(classify(classes.bar)),
            $track: $scroller.find(classify(classes.track)),
            $handle: $scroller.find(classify(classes.handle))
         }, opts);

         data.trackMargin = parseInt(data.trackMargin, 10);

         data.$content.on("scroll." + namespace, data, onScroll);
         data.$scroller.on(events.start, classify(classes.track), data, onTrackDown).on(events.start, classify(classes.handle), data, onHandleDown).data(namespace, data);

         pub.reset.apply($scroller);

         $(window).one("load", function () {
            pub.reset.apply($scroller);
         });
      }
   }

   /**
    * @method private
    * @name onScroll
    * @description Handles scroll event
    * @param e [object] "Event data"
    */
   function onScroll(e) {
      e.preventDefault();
      e.stopPropagation();

      var data = e.data,
          handleStyles = {};

      if (data.horizontal) {
         // Horizontal
         var scrollLeft = data.$content.scrollLeft();

         if (scrollLeft < 0) {
            scrollLeft = 0;
         }

         var handleLeft = scrollLeft / data.scrollRatio;

         if (handleLeft > data.handleBounds.right) {
            handleLeft = data.handleBounds.right;
         }

         handleStyles = {
            left: handleLeft
         };
      } else {
         // Vertical
         var scrollTop = data.$content.scrollTop();

         if (scrollTop < 0) {
            scrollTop = 0;
         }

         var handleTop = scrollTop / data.scrollRatio;

         if (handleTop > data.handleBounds.bottom) {
            handleTop = data.handleBounds.bottom;
         }

         handleStyles = {
            top: handleTop
         };
      }

      data.$handle.css(handleStyles);
   }

   /**
    * @method private
    * @name onTrackDown
    * @description Handles mousedown event on track
    * @param e [object] "Event data"
    */
   function onTrackDown(e) {
      e.preventDefault();
      e.stopPropagation();

      var data = e.data,
          oe = e.originalEvent,
          offset = data.$track.offset(),
          touch = typeof oe.targetTouches !== "undefined" ? oe.targetTouches[0] : null,
          pageX = touch ? touch.pageX : e.clientX,
          pageY = touch ? touch.pageY : e.clientY;

      if (data.horizontal) {
         // Horizontal
         data.mouseStart = pageX;
         data.handleLeft = pageX - offset.left - data.handleWidth / 2;

         position(data, data.handleLeft);
      } else {
         // Vertical
         data.mouseStart = pageY;
         data.handleTop = pageY - offset.top - data.handleHeight / 2;

         position(data, data.handleTop);
      }

      onStart(data);
   }

   /**
    * @method private
    * @name onHandleDown
    * @description Handles mousedown event on handle
    * @param e [object] "Event data"
    */
   function onHandleDown(e) {
      e.preventDefault();
      e.stopPropagation();

      var data = e.data,
          oe = e.originalEvent,
          touch = typeof oe.targetTouches !== "undefined" ? oe.targetTouches[0] : null,
          pageX = touch ? touch.pageX : e.clientX,
          pageY = touch ? touch.pageY : e.clientY;

      if (data.horizontal) {
         // Horizontal
         data.mouseStart = pageX;
         data.handleLeft = parseInt(data.$handle.css("left"), 10);
      } else {
         // Vertical
         data.mouseStart = pageY;
         data.handleTop = parseInt(data.$handle.css("top"), 10);
      }

      onStart(data);
   }

   /**
    * @method private
    * @name onStart
    * @description Handles touch.mouse start
    * @param data [object] "Instance data"
    */
   function onStart(data) {
      data.$content.off(classify(namespace));

      $body.on(events.move, data, onMouseMove).on(events.end, data, onMouseUp);
   }

   /**
    * @method private
    * @name onMouseMove
    * @description Handles mousemove event
    * @param e [object] "Event data"
    */
   function onMouseMove(e) {
      e.preventDefault();
      e.stopPropagation();

      var data = e.data,
          oe = e.originalEvent,
          pos = 0,
          delta = 0,
          touch = typeof oe.targetTouches !== "undefined" ? oe.targetTouches[0] : null,
          pageX = touch ? touch.pageX : e.clientX,
          pageY = touch ? touch.pageY : e.clientY;

      if (data.horizontal) {
         // Horizontal
         delta = data.mouseStart - pageX;
         pos = data.handleLeft - delta;
      } else {
         // Vertical
         delta = data.mouseStart - pageY;
         pos = data.handleTop - delta;
      }

      position(data, pos);
   }

   /**
    * @method private
    * @name onMouseUp
    * @description Handles mouseup event
    * @param e [object] "Event data"
    */
   function onMouseUp(e) {
      e.preventDefault();
      e.stopPropagation();

      var data = e.data;

      data.$content.on("scroll.scroller", data, onScroll);
      $body.off(".scroller");
   }

   /**
    * @method private
    * @name onTouchEnd
    * @description Handles mouseup event
    * @param e [object] "Event data"
    */
   function onTouchEnd(e) {
      e.preventDefault();
      e.stopPropagation();

      var data = e.data;

      data.$content.on("scroll.scroller", data, onScroll);
      $body.off(".scroller");
   }

   /**
    * @method private
    * @name position
    * @description Position handle based on scroll
    * @param data [object] "Instance data"
    * @param pos [int] "Scroll position"
    */
   function position(data, pos) {
      var handleStyles = {};

      if (data.horizontal) {
         // Horizontal
         if (pos < data.handleBounds.left) {
            pos = data.handleBounds.left;
         }

         if (pos > data.handleBounds.right) {
            pos = data.handleBounds.right;
         }

         var scrollLeft = Math.round(pos * data.scrollRatio);

         handleStyles = {
            left: pos
         };

         data.$content.scrollLeft(scrollLeft);
      } else {
         // Vertical
         if (pos < data.handleBounds.top) {
            pos = data.handleBounds.top;
         }

         if (pos > data.handleBounds.bottom) {
            pos = data.handleBounds.bottom;
         }

         var scrollTop = Math.round(pos * data.scrollRatio);

         handleStyles = {
            top: pos
         };

         data.$content.scrollTop(scrollTop);
      }

      data.$handle.css(handleStyles);
   }

   /**
    * @method private
    * @name classify
    * @description Create class selector from text
    * @param text [string] "Text to convert"
    * @return [string] "New class name"
    */
   function classify(text) {
      return "." + text;
   }

   $.fn[namespace] = function (method) {
      if (pub[method]) {
         return pub[method].apply(this, Array.prototype.slice.call(arguments, 1));
      } else if ((typeof method === "undefined" ? "undefined" : _typeof(method)) === 'object' || !method) {
         return init.apply(this, arguments);
      }
      return this;
   };

   $[namespace] = function (method) {
      if (method === "defaults") {
         pub.defaults.apply(this, Array.prototype.slice.call(arguments, 1));
      }
   };
})(jQuery);

;
(function () {
   var n = this,
       t = n._,
       r = Array.prototype,
       e = Object.prototype,
       u = Function.prototype,
       i = r.push,
       a = r.slice,
       o = r.concat,
       l = e.toString,
       c = e.hasOwnProperty,
       f = Array.isArray,
       s = Object.keys,
       p = u.bind,
       h = function h(n) {
      return n instanceof h ? n : this instanceof h ? void (this._wrapped = n) : new h(n);
   }; true ? ("undefined" != typeof module && module.exports && (exports = module.exports = h), exports._ = h) : n._ = h, h.VERSION = "1.7.0";var g = function g(n, t, r) {
      if (t === void 0) return n;switch (null == r ? 3 : r) {case 1:
            return function (r) {
               return n.call(t, r);
            };case 2:
            return function (r, e) {
               return n.call(t, r, e);
            };case 3:
            return function (r, e, u) {
               return n.call(t, r, e, u);
            };case 4:
            return function (r, e, u, i) {
               return n.call(t, r, e, u, i);
            };}return function () {
         return n.apply(t, arguments);
      };
   };h.iteratee = function (n, t, r) {
      return null == n ? h.identity : h.isFunction(n) ? g(n, t, r) : h.isObject(n) ? h.matches(n) : h.property(n);
   }, h.each = h.forEach = function (n, t, r) {
      if (null == n) return n;t = g(t, r);var e,
          u = n.length;if (u === +u) for (e = 0; u > e; e++) {
         t(n[e], e, n);
      } else {
         var i = h.keys(n);for (e = 0, u = i.length; u > e; e++) {
            t(n[i[e]], i[e], n);
         }
      }return n;
   }, h.map = h.collect = function (n, t, r) {
      if (null == n) return [];t = h.iteratee(t, r);for (var e, u = n.length !== +n.length && h.keys(n), i = (u || n).length, a = Array(i), o = 0; i > o; o++) {
         e = u ? u[o] : o, a[o] = t(n[e], e, n);
      }return a;
   };var v = "Reduce of empty array with no initial value";h.reduce = h.foldl = h.inject = function (n, t, r, e) {
      null == n && (n = []), t = g(t, e, 4);var u,
          i = n.length !== +n.length && h.keys(n),
          a = (i || n).length,
          o = 0;if (arguments.length < 3) {
         if (!a) throw new TypeError(v);r = n[i ? i[o++] : o++];
      }for (; a > o; o++) {
         u = i ? i[o] : o, r = t(r, n[u], u, n);
      }return r;
   }, h.reduceRight = h.foldr = function (n, t, r, e) {
      null == n && (n = []), t = g(t, e, 4);var u,
          i = n.length !== +n.length && h.keys(n),
          a = (i || n).length;if (arguments.length < 3) {
         if (!a) throw new TypeError(v);r = n[i ? i[--a] : --a];
      }for (; a--;) {
         u = i ? i[a] : a, r = t(r, n[u], u, n);
      }return r;
   }, h.find = h.detect = function (n, t, r) {
      var e;return t = h.iteratee(t, r), h.some(n, function (n, r, u) {
         return t(n, r, u) ? (e = n, !0) : void 0;
      }), e;
   }, h.filter = h.select = function (n, t, r) {
      var e = [];return null == n ? e : (t = h.iteratee(t, r), h.each(n, function (n, r, u) {
         t(n, r, u) && e.push(n);
      }), e);
   }, h.reject = function (n, t, r) {
      return h.filter(n, h.negate(h.iteratee(t)), r);
   }, h.every = h.all = function (n, t, r) {
      if (null == n) return !0;t = h.iteratee(t, r);var e,
          u,
          i = n.length !== +n.length && h.keys(n),
          a = (i || n).length;for (e = 0; a > e; e++) {
         if (u = i ? i[e] : e, !t(n[u], u, n)) return !1;
      }return !0;
   }, h.some = h.any = function (n, t, r) {
      if (null == n) return !1;t = h.iteratee(t, r);var e,
          u,
          i = n.length !== +n.length && h.keys(n),
          a = (i || n).length;for (e = 0; a > e; e++) {
         if (u = i ? i[e] : e, t(n[u], u, n)) return !0;
      }return !1;
   }, h.contains = h.include = function (n, t) {
      return null == n ? !1 : (n.length !== +n.length && (n = h.values(n)), h.indexOf(n, t) >= 0);
   }, h.invoke = function (n, t) {
      var r = a.call(arguments, 2),
          e = h.isFunction(t);return h.map(n, function (n) {
         return (e ? t : n[t]).apply(n, r);
      });
   }, h.pluck = function (n, t) {
      return h.map(n, h.property(t));
   }, h.where = function (n, t) {
      return h.filter(n, h.matches(t));
   }, h.findWhere = function (n, t) {
      return h.find(n, h.matches(t));
   }, h.max = function (n, t, r) {
      var e,
          u,
          i = -1 / 0,
          a = -1 / 0;if (null == t && null != n) {
         n = n.length === +n.length ? n : h.values(n);for (var o = 0, l = n.length; l > o; o++) {
            e = n[o], e > i && (i = e);
         }
      } else t = h.iteratee(t, r), h.each(n, function (n, r, e) {
         u = t(n, r, e), (u > a || u === -1 / 0 && i === -1 / 0) && (i = n, a = u);
      });return i;
   }, h.min = function (n, t, r) {
      var e,
          u,
          i = 1 / 0,
          a = 1 / 0;if (null == t && null != n) {
         n = n.length === +n.length ? n : h.values(n);for (var o = 0, l = n.length; l > o; o++) {
            e = n[o], i > e && (i = e);
         }
      } else t = h.iteratee(t, r), h.each(n, function (n, r, e) {
         u = t(n, r, e), (a > u || 1 / 0 === u && 1 / 0 === i) && (i = n, a = u);
      });return i;
   }, h.shuffle = function (n) {
      for (var t, r = n && n.length === +n.length ? n : h.values(n), e = r.length, u = Array(e), i = 0; e > i; i++) {
         t = h.random(0, i), t !== i && (u[i] = u[t]), u[t] = r[i];
      }return u;
   }, h.sample = function (n, t, r) {
      return null == t || r ? (n.length !== +n.length && (n = h.values(n)), n[h.random(n.length - 1)]) : h.shuffle(n).slice(0, Math.max(0, t));
   }, h.sortBy = function (n, t, r) {
      return t = h.iteratee(t, r), h.pluck(h.map(n, function (n, r, e) {
         return { value: n, index: r, criteria: t(n, r, e) };
      }).sort(function (n, t) {
         var r = n.criteria,
             e = t.criteria;if (r !== e) {
            if (r > e || r === void 0) return 1;if (e > r || e === void 0) return -1;
         }return n.index - t.index;
      }), "value");
   };var m = function m(n) {
      return function (t, r, e) {
         var u = {};return r = h.iteratee(r, e), h.each(t, function (e, i) {
            var a = r(e, i, t);n(u, e, a);
         }), u;
      };
   };h.groupBy = m(function (n, t, r) {
      h.has(n, r) ? n[r].push(t) : n[r] = [t];
   }), h.indexBy = m(function (n, t, r) {
      n[r] = t;
   }), h.countBy = m(function (n, t, r) {
      h.has(n, r) ? n[r]++ : n[r] = 1;
   }), h.sortedIndex = function (n, t, r, e) {
      r = h.iteratee(r, e, 1);for (var u = r(t), i = 0, a = n.length; a > i;) {
         var o = i + a >>> 1;r(n[o]) < u ? i = o + 1 : a = o;
      }return i;
   }, h.toArray = function (n) {
      return n ? h.isArray(n) ? a.call(n) : n.length === +n.length ? h.map(n, h.identity) : h.values(n) : [];
   }, h.size = function (n) {
      return null == n ? 0 : n.length === +n.length ? n.length : h.keys(n).length;
   }, h.partition = function (n, t, r) {
      t = h.iteratee(t, r);var e = [],
          u = [];return h.each(n, function (n, r, i) {
         (t(n, r, i) ? e : u).push(n);
      }), [e, u];
   }, h.first = h.head = h.take = function (n, t, r) {
      return null == n ? void 0 : null == t || r ? n[0] : 0 > t ? [] : a.call(n, 0, t);
   }, h.initial = function (n, t, r) {
      return a.call(n, 0, Math.max(0, n.length - (null == t || r ? 1 : t)));
   }, h.last = function (n, t, r) {
      return null == n ? void 0 : null == t || r ? n[n.length - 1] : a.call(n, Math.max(n.length - t, 0));
   }, h.rest = h.tail = h.drop = function (n, t, r) {
      return a.call(n, null == t || r ? 1 : t);
   }, h.compact = function (n) {
      return h.filter(n, h.identity);
   };var y = function y(n, t, r, e) {
      if (t && h.every(n, h.isArray)) return o.apply(e, n);for (var u = 0, a = n.length; a > u; u++) {
         var l = n[u];h.isArray(l) || h.isArguments(l) ? t ? i.apply(e, l) : y(l, t, r, e) : r || e.push(l);
      }return e;
   };h.flatten = function (n, t) {
      return y(n, t, !1, []);
   }, h.without = function (n) {
      return h.difference(n, a.call(arguments, 1));
   }, h.uniq = h.unique = function (n, t, r, e) {
      if (null == n) return [];h.isBoolean(t) || (e = r, r = t, t = !1), null != r && (r = h.iteratee(r, e));for (var u = [], i = [], a = 0, o = n.length; o > a; a++) {
         var l = n[a];if (t) a && i === l || u.push(l), i = l;else if (r) {
            var c = r(l, a, n);h.indexOf(i, c) < 0 && (i.push(c), u.push(l));
         } else h.indexOf(u, l) < 0 && u.push(l);
      }return u;
   }, h.union = function () {
      return h.uniq(y(arguments, !0, !0, []));
   }, h.intersection = function (n) {
      if (null == n) return [];for (var t = [], r = arguments.length, e = 0, u = n.length; u > e; e++) {
         var i = n[e];if (!h.contains(t, i)) {
            for (var a = 1; r > a && h.contains(arguments[a], i); a++) {}a === r && t.push(i);
         }
      }return t;
   }, h.difference = function (n) {
      var t = y(a.call(arguments, 1), !0, !0, []);return h.filter(n, function (n) {
         return !h.contains(t, n);
      });
   }, h.zip = function (n) {
      if (null == n) return [];for (var t = h.max(arguments, "length").length, r = Array(t), e = 0; t > e; e++) {
         r[e] = h.pluck(arguments, e);
      }return r;
   }, h.object = function (n, t) {
      if (null == n) return {};for (var r = {}, e = 0, u = n.length; u > e; e++) {
         t ? r[n[e]] = t[e] : r[n[e][0]] = n[e][1];
      }return r;
   }, h.indexOf = function (n, t, r) {
      if (null == n) return -1;var e = 0,
          u = n.length;if (r) {
         if ("number" != typeof r) return e = h.sortedIndex(n, t), n[e] === t ? e : -1;e = 0 > r ? Math.max(0, u + r) : r;
      }for (; u > e; e++) {
         if (n[e] === t) return e;
      }return -1;
   }, h.lastIndexOf = function (n, t, r) {
      if (null == n) return -1;var e = n.length;for ("number" == typeof r && (e = 0 > r ? e + r + 1 : Math.min(e, r + 1)); --e >= 0;) {
         if (n[e] === t) return e;
      }return -1;
   }, h.range = function (n, t, r) {
      arguments.length <= 1 && (t = n || 0, n = 0), r = r || 1;for (var e = Math.max(Math.ceil((t - n) / r), 0), u = Array(e), i = 0; e > i; i++, n += r) {
         u[i] = n;
      }return u;
   };var d = function d() {};h.bind = function (n, t) {
      var r, _e;if (p && n.bind === p) return p.apply(n, a.call(arguments, 1));if (!h.isFunction(n)) throw new TypeError("Bind must be called on a function");return r = a.call(arguments, 2), _e = function e() {
         if (!(this instanceof _e)) return n.apply(t, r.concat(a.call(arguments)));d.prototype = n.prototype;var u = new d();d.prototype = null;var i = n.apply(u, r.concat(a.call(arguments)));return h.isObject(i) ? i : u;
      };
   }, h.partial = function (n) {
      var t = a.call(arguments, 1);return function () {
         for (var r = 0, e = t.slice(), u = 0, i = e.length; i > u; u++) {
            e[u] === h && (e[u] = arguments[r++]);
         }for (; r < arguments.length;) {
            e.push(arguments[r++]);
         }return n.apply(this, e);
      };
   }, h.bindAll = function (n) {
      var t,
          r,
          e = arguments.length;if (1 >= e) throw new Error("bindAll must be passed function names");for (t = 1; e > t; t++) {
         r = arguments[t], n[r] = h.bind(n[r], n);
      }return n;
   }, h.memoize = function (n, t) {
      var r = function r(e) {
         var u = r.cache,
             i = t ? t.apply(this, arguments) : e;return h.has(u, i) || (u[i] = n.apply(this, arguments)), u[i];
      };return r.cache = {}, r;
   }, h.delay = function (n, t) {
      var r = a.call(arguments, 2);return setTimeout(function () {
         return n.apply(null, r);
      }, t);
   }, h.defer = function (n) {
      return h.delay.apply(h, [n, 1].concat(a.call(arguments, 1)));
   }, h.throttle = function (n, t, r) {
      var e,
          u,
          i,
          a = null,
          o = 0;r || (r = {});var l = function l() {
         o = r.leading === !1 ? 0 : h.now(), a = null, i = n.apply(e, u), a || (e = u = null);
      };return function () {
         var c = h.now();o || r.leading !== !1 || (o = c);var f = t - (c - o);return e = this, u = arguments, 0 >= f || f > t ? (clearTimeout(a), a = null, o = c, i = n.apply(e, u), a || (e = u = null)) : a || r.trailing === !1 || (a = setTimeout(l, f)), i;
      };
   }, h.debounce = function (n, t, r) {
      var e,
          u,
          i,
          a,
          o,
          l = function l() {
         var c = h.now() - a;t > c && c > 0 ? e = setTimeout(l, t - c) : (e = null, r || (o = n.apply(i, u), e || (i = u = null)));
      };return function () {
         i = this, u = arguments, a = h.now();var c = r && !e;return e || (e = setTimeout(l, t)), c && (o = n.apply(i, u), i = u = null), o;
      };
   }, h.wrap = function (n, t) {
      return h.partial(t, n);
   }, h.negate = function (n) {
      return function () {
         return !n.apply(this, arguments);
      };
   }, h.compose = function () {
      var n = arguments,
          t = n.length - 1;return function () {
         for (var r = t, e = n[t].apply(this, arguments); r--;) {
            e = n[r].call(this, e);
         }return e;
      };
   }, h.after = function (n, t) {
      return function () {
         return --n < 1 ? t.apply(this, arguments) : void 0;
      };
   }, h.before = function (n, t) {
      var r;return function () {
         return --n > 0 ? r = t.apply(this, arguments) : t = null, r;
      };
   }, h.once = h.partial(h.before, 2), h.keys = function (n) {
      if (!h.isObject(n)) return [];if (s) return s(n);var t = [];for (var r in n) {
         h.has(n, r) && t.push(r);
      }return t;
   }, h.values = function (n) {
      for (var t = h.keys(n), r = t.length, e = Array(r), u = 0; r > u; u++) {
         e[u] = n[t[u]];
      }return e;
   }, h.pairs = function (n) {
      for (var t = h.keys(n), r = t.length, e = Array(r), u = 0; r > u; u++) {
         e[u] = [t[u], n[t[u]]];
      }return e;
   }, h.invert = function (n) {
      for (var t = {}, r = h.keys(n), e = 0, u = r.length; u > e; e++) {
         t[n[r[e]]] = r[e];
      }return t;
   }, h.functions = h.methods = function (n) {
      var t = [];for (var r in n) {
         h.isFunction(n[r]) && t.push(r);
      }return t.sort();
   }, h.extend = function (n) {
      if (!h.isObject(n)) return n;for (var t, r, e = 1, u = arguments.length; u > e; e++) {
         t = arguments[e];for (r in t) {
            c.call(t, r) && (n[r] = t[r]);
         }
      }return n;
   }, h.pick = function (n, t, r) {
      var e,
          u = {};if (null == n) return u;if (h.isFunction(t)) {
         t = g(t, r);for (e in n) {
            var i = n[e];t(i, e, n) && (u[e] = i);
         }
      } else {
         var l = o.apply([], a.call(arguments, 1));n = new Object(n);for (var c = 0, f = l.length; f > c; c++) {
            e = l[c], e in n && (u[e] = n[e]);
         }
      }return u;
   }, h.omit = function (n, t, r) {
      if (h.isFunction(t)) t = h.negate(t);else {
         var e = h.map(o.apply([], a.call(arguments, 1)), String);t = function t(n, _t2) {
            return !h.contains(e, _t2);
         };
      }return h.pick(n, t, r);
   }, h.defaults = function (n) {
      if (!h.isObject(n)) return n;for (var t = 1, r = arguments.length; r > t; t++) {
         var e = arguments[t];for (var u in e) {
            n[u] === void 0 && (n[u] = e[u]);
         }
      }return n;
   }, h.clone = function (n) {
      return h.isObject(n) ? h.isArray(n) ? n.slice() : h.extend({}, n) : n;
   }, h.tap = function (n, t) {
      return t(n), n;
   };var b = function b(n, t, r, e) {
      if (n === t) return 0 !== n || 1 / n === 1 / t;if (null == n || null == t) return n === t;n instanceof h && (n = n._wrapped), t instanceof h && (t = t._wrapped);var u = l.call(n);if (u !== l.call(t)) return !1;switch (u) {case "[object RegExp]":case "[object String]":
            return "" + n == "" + t;case "[object Number]":
            return +n !== +n ? +t !== +t : 0 === +n ? 1 / +n === 1 / t : +n === +t;case "[object Date]":case "[object Boolean]":
            return +n === +t;}if ("object" != (typeof n === "undefined" ? "undefined" : _typeof(n)) || "object" != (typeof t === "undefined" ? "undefined" : _typeof(t))) return !1;for (var i = r.length; i--;) {
         if (r[i] === n) return e[i] === t;
      }var a = n.constructor,
          o = t.constructor;if (a !== o && "constructor" in n && "constructor" in t && !(h.isFunction(a) && a instanceof a && h.isFunction(o) && o instanceof o)) return !1;r.push(n), e.push(t);var c, f;if ("[object Array]" === u) {
         if (c = n.length, f = c === t.length) for (; c-- && (f = b(n[c], t[c], r, e));) {}
      } else {
         var s,
             p = h.keys(n);if (c = p.length, f = h.keys(t).length === c) for (; c-- && (s = p[c], f = h.has(t, s) && b(n[s], t[s], r, e));) {}
      }return r.pop(), e.pop(), f;
   };h.isEqual = function (n, t) {
      return b(n, t, [], []);
   }, h.isEmpty = function (n) {
      if (null == n) return !0;if (h.isArray(n) || h.isString(n) || h.isArguments(n)) return 0 === n.length;for (var t in n) {
         if (h.has(n, t)) return !1;
      }return !0;
   }, h.isElement = function (n) {
      return !(!n || 1 !== n.nodeType);
   }, h.isArray = f || function (n) {
      return "[object Array]" === l.call(n);
   }, h.isObject = function (n) {
      var t = typeof n === "undefined" ? "undefined" : _typeof(n);return "function" === t || "object" === t && !!n;
   }, h.each(["Arguments", "Function", "String", "Number", "Date", "RegExp"], function (n) {
      h["is" + n] = function (t) {
         return l.call(t) === "[object " + n + "]";
      };
   }), h.isArguments(arguments) || (h.isArguments = function (n) {
      return h.has(n, "callee");
   }), "function" != typeof /./ && (h.isFunction = function (n) {
      return "function" == typeof n || !1;
   }), h.isFinite = function (n) {
      return isFinite(n) && !isNaN(parseFloat(n));
   }, h.isNaN = function (n) {
      return h.isNumber(n) && n !== +n;
   }, h.isBoolean = function (n) {
      return n === !0 || n === !1 || "[object Boolean]" === l.call(n);
   }, h.isNull = function (n) {
      return null === n;
   }, h.isUndefined = function (n) {
      return n === void 0;
   }, h.has = function (n, t) {
      return null != n && c.call(n, t);
   }, h.noConflict = function () {
      return n._ = t, this;
   }, h.identity = function (n) {
      return n;
   }, h.constant = function (n) {
      return function () {
         return n;
      };
   }, h.noop = function () {}, h.property = function (n) {
      return function (t) {
         return t[n];
      };
   }, h.matches = function (n) {
      var t = h.pairs(n),
          r = t.length;return function (n) {
         if (null == n) return !r;n = new Object(n);for (var e = 0; r > e; e++) {
            var u = t[e],
                i = u[0];if (u[1] !== n[i] || !(i in n)) return !1;
         }return !0;
      };
   }, h.times = function (n, t, r) {
      var e = Array(Math.max(0, n));t = g(t, r, 1);for (var u = 0; n > u; u++) {
         e[u] = t(u);
      }return e;
   }, h.random = function (n, t) {
      return null == t && (t = n, n = 0), n + Math.floor(Math.random() * (t - n + 1));
   }, h.now = Date.now || function () {
      return new Date().getTime();
   };var _ = { "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#x27;", "`": "&#x60;" },
       w = h.invert(_),
       j = function j(n) {
      var t = function t(_t3) {
         return n[_t3];
      },
          r = "(?:" + h.keys(n).join("|") + ")",
          e = RegExp(r),
          u = RegExp(r, "g");return function (n) {
         return n = null == n ? "" : "" + n, e.test(n) ? n.replace(u, t) : n;
      };
   };h.escape = j(_), h.unescape = j(w), h.result = function (n, t) {
      if (null == n) return void 0;var r = n[t];return h.isFunction(r) ? n[t]() : r;
   };var x = 0;h.uniqueId = function (n) {
      var t = ++x + "";return n ? n + t : t;
   }, h.templateSettings = { evaluate: /<%([\s\S]+?)%>/g, interpolate: /<%=([\s\S]+?)%>/g, escape: /<%-([\s\S]+?)%>/g };var A = /(.)^/,
       k = { "'": "'", "\\": "\\", "\r": "r", "\n": "n", "\u2028": "u2028", "\u2029": "u2029" },
       O = /\\|'|\r|\n|\u2028|\u2029/g,
       F = function F(n) {
      return "\\" + k[n];
   };h.template = function (n, t, r) {
      !t && r && (t = r), t = h.defaults({}, t, h.templateSettings);var e = RegExp([(t.escape || A).source, (t.interpolate || A).source, (t.evaluate || A).source].join("|") + "|$", "g"),
          u = 0,
          i = "__p+='";n.replace(e, function (t, r, e, a, o) {
         return i += n.slice(u, o).replace(O, F), u = o + t.length, r ? i += "'+\n((__t=(" + r + "))==null?'':_.escape(__t))+\n'" : e ? i += "'+\n((__t=(" + e + "))==null?'':__t)+\n'" : a && (i += "';\n" + a + "\n__p+='"), t;
      }), i += "';\n", t.variable || (i = "with(obj||{}){\n" + i + "}\n"), i = "var __t,__p='',__j=Array.prototype.join," + "print=function(){__p+=__j.call(arguments,'');};\n" + i + "return __p;\n";try {
         var a = new Function(t.variable || "obj", "_", i);
      } catch (o) {
         throw o.source = i, o;
      }var l = function l(n) {
         return a.call(this, n, h);
      },
          c = t.variable || "obj";return l.source = "function(" + c + "){\n" + i + "}", l;
   }, h.chain = function (n) {
      var t = h(n);return t._chain = !0, t;
   };var E = function E(n) {
      return this._chain ? h(n).chain() : n;
   };h.mixin = function (n) {
      h.each(h.functions(n), function (t) {
         var r = h[t] = n[t];h.prototype[t] = function () {
            var n = [this._wrapped];return i.apply(n, arguments), E.call(this, r.apply(h, n));
         };
      });
   }, h.mixin(h), h.each(["pop", "push", "reverse", "shift", "sort", "splice", "unshift"], function (n) {
      var t = r[n];h.prototype[n] = function () {
         var r = this._wrapped;return t.apply(r, arguments), "shift" !== n && "splice" !== n || 0 !== r.length || delete r[0], E.call(this, r);
      };
   }), h.each(["concat", "join", "slice"], function (n) {
      var t = r[n];h.prototype[n] = function () {
         return E.call(this, t.apply(this._wrapped, arguments));
      };
   }), h.prototype.value = function () {
      return this._wrapped;
   }, "function" == "function" && __webpack_require__(41) && !(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_AMD_DEFINE_RESULT__ = function () {
      return h;
   }.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
}).call(this);

/*!
 * Bootstrap v3.3.1 (http://getbootstrap.com)
 * Copyright 2011-2014 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
*/
;
if ("undefined" == typeof jQuery) throw new Error("Bootstrap's JavaScript requires jQuery");+function (a) {
   var b = a.fn.jquery.split(" ")[0].split(".");if (b[0] < 2 && b[1] < 9 || 1 == b[0] && 9 == b[1] && b[2] < 1) throw new Error("Bootstrap's JavaScript requires jQuery version 1.9.1 or higher");
}(jQuery), +function (a) {
   "use strict";
   function b() {
      var a = document.createElement("bootstrap"),
          b = { WebkitTransition: "webkitTransitionEnd", MozTransition: "transitionend", OTransition: "oTransitionEnd otransitionend", transition: "transitionend" };for (var c in b) {
         if (void 0 !== a.style[c]) return { end: b[c] };
      }return !1;
   }a.fn.emulateTransitionEnd = function (b) {
      var c = !1,
          d = this;a(this).one("bsTransitionEnd", function () {
         c = !0;
      });var e = function e() {
         c || a(d).trigger(a.support.transition.end);
      };return setTimeout(e, b), this;
   }, a(function () {
      a.support.transition = b(), a.support.transition && (a.event.special.bsTransitionEnd = { bindType: a.support.transition.end, delegateType: a.support.transition.end, handle: function handle(b) {
            return a(b.target).is(this) ? b.handleObj.handler.apply(this, arguments) : void 0;
         } });
   });
}(jQuery), +function (a) {
   "use strict";
   function b(b) {
      return this.each(function () {
         var c = a(this),
             e = c.data("bs.alert");e || c.data("bs.alert", e = new d(this)), "string" == typeof b && e[b].call(c);
      });
   }var c = '[data-dismiss="alert"]',
       d = function d(b) {
      a(b).on("click", c, this.close);
   };d.VERSION = "3.3.1", d.TRANSITION_DURATION = 150, d.prototype.close = function (b) {
      function c() {
         g.detach().trigger("closed.bs.alert").remove();
      }var e = a(this),
          f = e.attr("data-target");f || (f = e.attr("href"), f = f && f.replace(/.*(?=#[^\s]*$)/, ""));var g = a(f);b && b.preventDefault(), g.length || (g = e.closest(".alert")), g.trigger(b = a.Event("close.bs.alert")), b.isDefaultPrevented() || (g.removeClass("in"), a.support.transition && g.hasClass("fade") ? g.one("bsTransitionEnd", c).emulateTransitionEnd(d.TRANSITION_DURATION) : c());
   };var e = a.fn.alert;a.fn.alert = b, a.fn.alert.Constructor = d, a.fn.alert.noConflict = function () {
      return a.fn.alert = e, this;
   }, a(document).on("click.bs.alert.data-api", c, d.prototype.close);
}(jQuery), +function (a) {
   "use strict";
   function b(b) {
      return this.each(function () {
         var d = a(this),
             e = d.data("bs.button"),
             f = "object" == (typeof b === "undefined" ? "undefined" : _typeof(b)) && b;e || d.data("bs.button", e = new c(this, f)), "toggle" == b ? e.toggle() : b && e.setState(b);
      });
   }var c = function c(b, d) {
      this.$element = a(b), this.options = a.extend({}, c.DEFAULTS, d), this.isLoading = !1;
   };c.VERSION = "3.3.1", c.DEFAULTS = { loadingText: "loading..." }, c.prototype.setState = function (b) {
      var c = "disabled",
          d = this.$element,
          e = d.is("input") ? "val" : "html",
          f = d.data();b += "Text", null == f.resetText && d.data("resetText", d[e]()), setTimeout(a.proxy(function () {
         d[e](null == f[b] ? this.options[b] : f[b]), "loadingText" == b ? (this.isLoading = !0, d.addClass(c).attr(c, c)) : this.isLoading && (this.isLoading = !1, d.removeClass(c).removeAttr(c));
      }, this), 0);
   }, c.prototype.toggle = function () {
      var a = !0,
          b = this.$element.closest('[data-toggle="buttons"]');if (b.length) {
         var c = this.$element.find("input");"radio" == c.prop("type") && (c.prop("checked") && this.$element.hasClass("active") ? a = !1 : b.find(".active").removeClass("active")), a && c.prop("checked", !this.$element.hasClass("active")).trigger("change");
      } else this.$element.attr("aria-pressed", !this.$element.hasClass("active"));a && this.$element.toggleClass("active");
   };var d = a.fn.button;a.fn.button = b, a.fn.button.Constructor = c, a.fn.button.noConflict = function () {
      return a.fn.button = d, this;
   }, a(document).on("click.bs.button.data-api", '[data-toggle^="button"]', function (c) {
      var d = a(c.target);d.hasClass("btn") || (d = d.closest(".btn")), b.call(d, "toggle"), c.preventDefault();
   }).on("focus.bs.button.data-api blur.bs.button.data-api", '[data-toggle^="button"]', function (b) {
      a(b.target).closest(".btn").toggleClass("focus", /^focus(in)?$/.test(b.type));
   });
}(jQuery), +function (a) {
   "use strict";
   function b(b) {
      return this.each(function () {
         var d = a(this),
             e = d.data("bs.carousel"),
             f = a.extend({}, c.DEFAULTS, d.data(), "object" == (typeof b === "undefined" ? "undefined" : _typeof(b)) && b),
             g = "string" == typeof b ? b : f.slide;e || d.data("bs.carousel", e = new c(this, f)), "number" == typeof b ? e.to(b) : g ? e[g]() : f.interval && e.pause().cycle();
      });
   }var c = function c(b, _c) {
      this.$element = a(b), this.$indicators = this.$element.find(".carousel-indicators"), this.options = _c, this.paused = this.sliding = this.interval = this.$active = this.$items = null, this.options.keyboard && this.$element.on("keydown.bs.carousel", a.proxy(this.keydown, this)), "hover" == this.options.pause && !("ontouchstart" in document.documentElement) && this.$element.on("mouseenter.bs.carousel", a.proxy(this.pause, this)).on("mouseleave.bs.carousel", a.proxy(this.cycle, this));
   };c.VERSION = "3.3.1", c.TRANSITION_DURATION = 600, c.DEFAULTS = { interval: 5e3, pause: "hover", wrap: !0, keyboard: !0 }, c.prototype.keydown = function (a) {
      if (!/input|textarea/i.test(a.target.tagName)) {
         switch (a.which) {case 37:
               this.prev();break;case 39:
               this.next();break;default:
               return;}a.preventDefault();
      }
   }, c.prototype.cycle = function (b) {
      return b || (this.paused = !1), this.interval && clearInterval(this.interval), this.options.interval && !this.paused && (this.interval = setInterval(a.proxy(this.next, this), this.options.interval)), this;
   }, c.prototype.getItemIndex = function (a) {
      return this.$items = a.parent().children(".item"), this.$items.index(a || this.$active);
   }, c.prototype.getItemForDirection = function (a, b) {
      var c = "prev" == a ? -1 : 1,
          d = this.getItemIndex(b),
          e = (d + c) % this.$items.length;return this.$items.eq(e);
   }, c.prototype.to = function (a) {
      var b = this,
          c = this.getItemIndex(this.$active = this.$element.find(".item.active"));return a > this.$items.length - 1 || 0 > a ? void 0 : this.sliding ? this.$element.one("slid.bs.carousel", function () {
         b.to(a);
      }) : c == a ? this.pause().cycle() : this.slide(a > c ? "next" : "prev", this.$items.eq(a));
   }, c.prototype.pause = function (b) {
      return b || (this.paused = !0), this.$element.find(".next, .prev").length && a.support.transition && (this.$element.trigger(a.support.transition.end), this.cycle(!0)), this.interval = clearInterval(this.interval), this;
   }, c.prototype.next = function () {
      return this.sliding ? void 0 : this.slide("next");
   }, c.prototype.prev = function () {
      return this.sliding ? void 0 : this.slide("prev");
   }, c.prototype.slide = function (b, d) {
      var e = this.$element.find(".item.active"),
          f = d || this.getItemForDirection(b, e),
          g = this.interval,
          h = "next" == b ? "left" : "right",
          i = "next" == b ? "first" : "last",
          j = this;if (!f.length) {
         if (!this.options.wrap) return;f = this.$element.find(".item")[i]();
      }if (f.hasClass("active")) return this.sliding = !1;var k = f[0],
          l = a.Event("slide.bs.carousel", { relatedTarget: k, direction: h });if (this.$element.trigger(l), !l.isDefaultPrevented()) {
         if (this.sliding = !0, g && this.pause(), this.$indicators.length) {
            this.$indicators.find(".active").removeClass("active");var m = a(this.$indicators.children()[this.getItemIndex(f)]);m && m.addClass("active");
         }var n = a.Event("slid.bs.carousel", { relatedTarget: k, direction: h });return a.support.transition && this.$element.hasClass("slide") ? (f.addClass(b), f[0].offsetWidth, e.addClass(h), f.addClass(h), e.one("bsTransitionEnd", function () {
            f.removeClass([b, h].join(" ")).addClass("active"), e.removeClass(["active", h].join(" ")), j.sliding = !1, setTimeout(function () {
               j.$element.trigger(n);
            }, 0);
         }).emulateTransitionEnd(c.TRANSITION_DURATION)) : (e.removeClass("active"), f.addClass("active"), this.sliding = !1, this.$element.trigger(n)), g && this.cycle(), this;
      }
   };var d = a.fn.carousel;a.fn.carousel = b, a.fn.carousel.Constructor = c, a.fn.carousel.noConflict = function () {
      return a.fn.carousel = d, this;
   };var e = function e(c) {
      var d,
          e = a(this),
          f = a(e.attr("data-target") || (d = e.attr("href")) && d.replace(/.*(?=#[^\s]+$)/, ""));if (f.hasClass("carousel")) {
         var g = a.extend({}, f.data(), e.data()),
             h = e.attr("data-slide-to");h && (g.interval = !1), b.call(f, g), h && f.data("bs.carousel").to(h), c.preventDefault();
      }
   };a(document).on("click.bs.carousel.data-api", "[data-slide]", e).on("click.bs.carousel.data-api", "[data-slide-to]", e), a(window).on("load", function () {
      a('[data-ride="carousel"]').each(function () {
         var c = a(this);b.call(c, c.data());
      });
   });
}(jQuery), +function (a) {
   "use strict";
   function b(b) {
      var c,
          d = b.attr("data-target") || (c = b.attr("href")) && c.replace(/.*(?=#[^\s]+$)/, "");return a(d);
   }function c(b) {
      return this.each(function () {
         var c = a(this),
             e = c.data("bs.collapse"),
             f = a.extend({}, d.DEFAULTS, c.data(), "object" == (typeof b === "undefined" ? "undefined" : _typeof(b)) && b);!e && f.toggle && "show" == b && (f.toggle = !1), e || c.data("bs.collapse", e = new d(this, f)), "string" == typeof b && e[b]();
      });
   }var d = function d(b, c) {
      this.$element = a(b), this.options = a.extend({}, d.DEFAULTS, c), this.$trigger = a(this.options.trigger).filter('[href="#' + b.id + '"], [data-target="#' + b.id + '"]'), this.transitioning = null, this.options.parent ? this.$parent = this.getParent() : this.addAriaAndCollapsedClass(this.$element, this.$trigger), this.options.toggle && this.toggle();
   };d.VERSION = "3.3.1", d.TRANSITION_DURATION = 350, d.DEFAULTS = { toggle: !0, trigger: '[data-toggle="collapse"]' }, d.prototype.dimension = function () {
      var a = this.$element.hasClass("width");return a ? "width" : "height";
   }, d.prototype.show = function () {
      if (!this.transitioning && !this.$element.hasClass("in")) {
         var b,
             e = this.$parent && this.$parent.find("> .panel").children(".in, .collapsing");if (!(e && e.length && (b = e.data("bs.collapse"), b && b.transitioning))) {
            var f = a.Event("show.bs.collapse");if (this.$element.trigger(f), !f.isDefaultPrevented()) {
               e && e.length && (c.call(e, "hide"), b || e.data("bs.collapse", null));var g = this.dimension();this.$element.removeClass("collapse").addClass("collapsing")[g](0).attr("aria-expanded", !0), this.$trigger.removeClass("collapsed").attr("aria-expanded", !0), this.transitioning = 1;var h = function h() {
                  this.$element.removeClass("collapsing").addClass("collapse in")[g](""), this.transitioning = 0, this.$element.trigger("shown.bs.collapse");
               };if (!a.support.transition) return h.call(this);var i = a.camelCase(["scroll", g].join("-"));this.$element.one("bsTransitionEnd", a.proxy(h, this)).emulateTransitionEnd(d.TRANSITION_DURATION)[g](this.$element[0][i]);
            }
         }
      }
   }, d.prototype.hide = function () {
      if (!this.transitioning && this.$element.hasClass("in")) {
         var b = a.Event("hide.bs.collapse");if (this.$element.trigger(b), !b.isDefaultPrevented()) {
            var c = this.dimension();this.$element[c](this.$element[c]())[0].offsetHeight, this.$element.addClass("collapsing").removeClass("collapse in").attr("aria-expanded", !1), this.$trigger.addClass("collapsed").attr("aria-expanded", !1), this.transitioning = 1;var e = function e() {
               this.transitioning = 0, this.$element.removeClass("collapsing").addClass("collapse").trigger("hidden.bs.collapse");
            };return a.support.transition ? void this.$element[c](0).one("bsTransitionEnd", a.proxy(e, this)).emulateTransitionEnd(d.TRANSITION_DURATION) : e.call(this);
         }
      }
   }, d.prototype.toggle = function () {
      this[this.$element.hasClass("in") ? "hide" : "show"]();
   }, d.prototype.getParent = function () {
      return a(this.options.parent).find('[data-toggle="collapse"][data-parent="' + this.options.parent + '"]').each(a.proxy(function (c, d) {
         var e = a(d);this.addAriaAndCollapsedClass(b(e), e);
      }, this)).end();
   }, d.prototype.addAriaAndCollapsedClass = function (a, b) {
      var c = a.hasClass("in");a.attr("aria-expanded", c), b.toggleClass("collapsed", !c).attr("aria-expanded", c);
   };var e = a.fn.collapse;a.fn.collapse = c, a.fn.collapse.Constructor = d, a.fn.collapse.noConflict = function () {
      return a.fn.collapse = e, this;
   }, a(document).on("click.bs.collapse.data-api", '[data-toggle="collapse"]', function (d) {
      var e = a(this);e.attr("data-target") || d.preventDefault();var f = b(e),
          g = f.data("bs.collapse"),
          h = g ? "toggle" : a.extend({}, e.data(), { trigger: this });c.call(f, h);
   });
}(jQuery), +function (a) {
   "use strict";
   function b(b) {
      b && 3 === b.which || (a(e).remove(), a(f).each(function () {
         var d = a(this),
             e = c(d),
             f = { relatedTarget: this };e.hasClass("open") && (e.trigger(b = a.Event("hide.bs.dropdown", f)), b.isDefaultPrevented() || (d.attr("aria-expanded", "false"), e.removeClass("open").trigger("hidden.bs.dropdown", f)));
      }));
   }function c(b) {
      var c = b.attr("data-target");c || (c = b.attr("href"), c = c && /#[A-Za-z]/.test(c) && c.replace(/.*(?=#[^\s]*$)/, ""));var d = c && a(c);return d && d.length ? d : b.parent();
   }function d(b) {
      return this.each(function () {
         var c = a(this),
             d = c.data("bs.dropdown");d || c.data("bs.dropdown", d = new g(this)), "string" == typeof b && d[b].call(c);
      });
   }var e = ".dropdown-backdrop",
       f = '[data-toggle="dropdown"]',
       g = function g(b) {
      a(b).on("click.bs.dropdown", this.toggle);
   };g.VERSION = "3.3.1", g.prototype.toggle = function (d) {
      var e = a(this);if (!e.is(".disabled, :disabled")) {
         var f = c(e),
             g = f.hasClass("open");if (b(), !g) {
            "ontouchstart" in document.documentElement && !f.closest(".navbar-nav").length && a('<div class="dropdown-backdrop"/>').insertAfter(a(this)).on("click", b);var h = { relatedTarget: this };if (f.trigger(d = a.Event("show.bs.dropdown", h)), d.isDefaultPrevented()) return;e.trigger("focus").attr("aria-expanded", "true"), f.toggleClass("open").trigger("shown.bs.dropdown", h);
         }return !1;
      }
   }, g.prototype.keydown = function (b) {
      if (/(38|40|27|32)/.test(b.which) && !/input|textarea/i.test(b.target.tagName)) {
         var d = a(this);if (b.preventDefault(), b.stopPropagation(), !d.is(".disabled, :disabled")) {
            var e = c(d),
                g = e.hasClass("open");if (!g && 27 != b.which || g && 27 == b.which) return 27 == b.which && e.find(f).trigger("focus"), d.trigger("click");var h = " li:not(.divider):visible a",
                i = e.find('[role="menu"]' + h + ', [role="listbox"]' + h);if (i.length) {
               var j = i.index(b.target);38 == b.which && j > 0 && j--, 40 == b.which && j < i.length - 1 && j++, ~j || (j = 0), i.eq(j).trigger("focus");
            }
         }
      }
   };var h = a.fn.dropdown;a.fn.dropdown = d, a.fn.dropdown.Constructor = g, a.fn.dropdown.noConflict = function () {
      return a.fn.dropdown = h, this;
   }, a(document).on("click.bs.dropdown.data-api", b).on("click.bs.dropdown.data-api", ".dropdown form", function (a) {
      a.stopPropagation();
   }).on("click.bs.dropdown.data-api", f, g.prototype.toggle).on("keydown.bs.dropdown.data-api", f, g.prototype.keydown).on("keydown.bs.dropdown.data-api", '[role="menu"]', g.prototype.keydown).on("keydown.bs.dropdown.data-api", '[role="listbox"]', g.prototype.keydown);
}(jQuery), +function (a) {
   "use strict";
   function b(b, d) {
      return this.each(function () {
         var e = a(this),
             f = e.data("bs.modal"),
             g = a.extend({}, c.DEFAULTS, e.data(), "object" == (typeof b === "undefined" ? "undefined" : _typeof(b)) && b);f || e.data("bs.modal", f = new c(this, g)), "string" == typeof b ? f[b](d) : g.show && f.show(d);
      });
   }var c = function c(b, _c2) {
      this.options = _c2, this.$body = a(document.body), this.$element = a(b), this.$backdrop = this.isShown = null, this.scrollbarWidth = 0, this.options.remote && this.$element.find(".modal-content").load(this.options.remote, a.proxy(function () {
         this.$element.trigger("loaded.bs.modal");
      }, this));
   };c.VERSION = "3.3.1", c.TRANSITION_DURATION = 300, c.BACKDROP_TRANSITION_DURATION = 150, c.DEFAULTS = { backdrop: !0, keyboard: !0, show: !0 }, c.prototype.toggle = function (a) {
      return this.isShown ? this.hide() : this.show(a);
   }, c.prototype.show = function (b) {
      var d = this,
          e = a.Event("show.bs.modal", { relatedTarget: b });this.$element.trigger(e), this.isShown || e.isDefaultPrevented() || (this.isShown = !0, this.checkScrollbar(), this.setScrollbar(), this.$body.addClass("modal-open"), this.escape(), this.resize(), this.$element.on("click.dismiss.bs.modal", '[data-dismiss="modal"]', a.proxy(this.hide, this)), this.backdrop(function () {
         var e = a.support.transition && d.$element.hasClass("fade");d.$element.parent().length || d.$element.appendTo(d.$body), d.$element.show().scrollTop(0), d.options.backdrop && d.adjustBackdrop(), d.adjustDialog(), e && d.$element[0].offsetWidth, d.$element.addClass("in").attr("aria-hidden", !1), d.enforceFocus();var f = a.Event("shown.bs.modal", { relatedTarget: b });e ? d.$element.find(".modal-dialog").one("bsTransitionEnd", function () {
            d.$element.trigger("focus").trigger(f);
         }).emulateTransitionEnd(c.TRANSITION_DURATION) : d.$element.trigger("focus").trigger(f);
      }));
   }, c.prototype.hide = function (b) {
      b && b.preventDefault(), b = a.Event("hide.bs.modal"), this.$element.trigger(b), this.isShown && !b.isDefaultPrevented() && (this.isShown = !1, this.escape(), this.resize(), a(document).off("focusin.bs.modal"), this.$element.removeClass("in").attr("aria-hidden", !0).off("click.dismiss.bs.modal"), a.support.transition && this.$element.hasClass("fade") ? this.$element.one("bsTransitionEnd", a.proxy(this.hideModal, this)).emulateTransitionEnd(c.TRANSITION_DURATION) : this.hideModal());
   }, c.prototype.enforceFocus = function () {
      a(document).off("focusin.bs.modal").on("focusin.bs.modal", a.proxy(function (a) {
         this.$element[0] === a.target || this.$element.has(a.target).length || this.$element.trigger("focus");
      }, this));
   }, c.prototype.escape = function () {
      this.isShown && this.options.keyboard ? this.$element.on("keydown.dismiss.bs.modal", a.proxy(function (a) {
         27 == a.which && this.hide();
      }, this)) : this.isShown || this.$element.off("keydown.dismiss.bs.modal");
   }, c.prototype.resize = function () {
      this.isShown ? a(window).on("resize.bs.modal", a.proxy(this.handleUpdate, this)) : a(window).off("resize.bs.modal");
   }, c.prototype.hideModal = function () {
      var a = this;this.$element.hide(), this.backdrop(function () {
         a.$body.removeClass("modal-open"), a.resetAdjustments(), a.resetScrollbar(), a.$element.trigger("hidden.bs.modal");
      });
   }, c.prototype.removeBackdrop = function () {
      this.$backdrop && this.$backdrop.remove(), this.$backdrop = null;
   }, c.prototype.backdrop = function (b) {
      var d = this,
          e = this.$element.hasClass("fade") ? "fade" : "";if (this.isShown && this.options.backdrop) {
         var f = a.support.transition && e;if (this.$backdrop = a('<div class="modal-backdrop ' + e + '" />').prependTo(this.$element).on("click.dismiss.bs.modal", a.proxy(function (a) {
            a.target === a.currentTarget && ("static" == this.options.backdrop ? this.$element[0].focus.call(this.$element[0]) : this.hide.call(this));
         }, this)), f && this.$backdrop[0].offsetWidth, this.$backdrop.addClass("in"), !b) return;f ? this.$backdrop.one("bsTransitionEnd", b).emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION) : b();
      } else if (!this.isShown && this.$backdrop) {
         this.$backdrop.removeClass("in");var g = function g() {
            d.removeBackdrop(), b && b();
         };a.support.transition && this.$element.hasClass("fade") ? this.$backdrop.one("bsTransitionEnd", g).emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION) : g();
      } else b && b();
   }, c.prototype.handleUpdate = function () {
      this.options.backdrop && this.adjustBackdrop(), this.adjustDialog();
   }, c.prototype.adjustBackdrop = function () {
      this.$backdrop.css("height", 0).css("height", this.$element[0].scrollHeight);
   }, c.prototype.adjustDialog = function () {
      var a = this.$element[0].scrollHeight > document.documentElement.clientHeight;this.$element.css({ paddingLeft: !this.bodyIsOverflowing && a ? this.scrollbarWidth : "", paddingRight: this.bodyIsOverflowing && !a ? this.scrollbarWidth : "" });
   }, c.prototype.resetAdjustments = function () {
      this.$element.css({ paddingLeft: "", paddingRight: "" });
   }, c.prototype.checkScrollbar = function () {
      this.bodyIsOverflowing = document.body.scrollHeight > document.documentElement.clientHeight, this.scrollbarWidth = this.measureScrollbar();
   }, c.prototype.setScrollbar = function () {
      var a = parseInt(this.$body.css("padding-right") || 0, 10);this.bodyIsOverflowing && this.$body.css("padding-right", a + this.scrollbarWidth);
   }, c.prototype.resetScrollbar = function () {
      this.$body.css("padding-right", "");
   }, c.prototype.measureScrollbar = function () {
      var a = document.createElement("div");a.className = "modal-scrollbar-measure", this.$body.append(a);var b = a.offsetWidth - a.clientWidth;return this.$body[0].removeChild(a), b;
   };var d = a.fn.modal;a.fn.modal = b, a.fn.modal.Constructor = c, a.fn.modal.noConflict = function () {
      return a.fn.modal = d, this;
   }, a(document).on("click.bs.modal.data-api", '[data-toggle="modal"]', function (c) {
      var d = a(this),
          e = d.attr("href"),
          f = a(d.attr("data-target") || e && e.replace(/.*(?=#[^\s]+$)/, "")),
          g = f.data("bs.modal") ? "toggle" : a.extend({ remote: !/#/.test(e) && e }, f.data(), d.data());d.is("a") && c.preventDefault(), f.one("show.bs.modal", function (a) {
         a.isDefaultPrevented() || f.one("hidden.bs.modal", function () {
            d.is(":visible") && d.trigger("focus");
         });
      }), b.call(f, g, this);
   });
}(jQuery), +function (a) {
   "use strict";
   function b(b) {
      return this.each(function () {
         var d = a(this),
             e = d.data("bs.tooltip"),
             f = "object" == (typeof b === "undefined" ? "undefined" : _typeof(b)) && b,
             g = f && f.selector;(e || "destroy" != b) && (g ? (e || d.data("bs.tooltip", e = {}), e[g] || (e[g] = new c(this, f))) : e || d.data("bs.tooltip", e = new c(this, f)), "string" == typeof b && e[b]());
      });
   }var c = function c(a, b) {
      this.type = this.options = this.enabled = this.timeout = this.hoverState = this.$element = null, this.init("tooltip", a, b);
   };c.VERSION = "3.3.1", c.TRANSITION_DURATION = 150, c.DEFAULTS = { animation: !0, placement: "top", selector: !1, template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>', trigger: "hover focus", title: "", delay: 0, html: !1, container: !1, viewport: { selector: "body", padding: 0 } }, c.prototype.init = function (b, c, d) {
      this.enabled = !0, this.type = b, this.$element = a(c), this.options = this.getOptions(d), this.$viewport = this.options.viewport && a(this.options.viewport.selector || this.options.viewport);for (var e = this.options.trigger.split(" "), f = e.length; f--;) {
         var g = e[f];if ("click" == g) this.$element.on("click." + this.type, this.options.selector, a.proxy(this.toggle, this));else if ("manual" != g) {
            var h = "hover" == g ? "mouseenter" : "focusin",
                i = "hover" == g ? "mouseleave" : "focusout";this.$element.on(h + "." + this.type, this.options.selector, a.proxy(this.enter, this)), this.$element.on(i + "." + this.type, this.options.selector, a.proxy(this.leave, this));
         }
      }this.options.selector ? this._options = a.extend({}, this.options, { trigger: "manual", selector: "" }) : this.fixTitle();
   }, c.prototype.getDefaults = function () {
      return c.DEFAULTS;
   }, c.prototype.getOptions = function (b) {
      return b = a.extend({}, this.getDefaults(), this.$element.data(), b), b.delay && "number" == typeof b.delay && (b.delay = { show: b.delay, hide: b.delay }), b;
   }, c.prototype.getDelegateOptions = function () {
      var b = {},
          c = this.getDefaults();return this._options && a.each(this._options, function (a, d) {
         c[a] != d && (b[a] = d);
      }), b;
   }, c.prototype.enter = function (b) {
      var c = b instanceof this.constructor ? b : a(b.currentTarget).data("bs." + this.type);return c && c.$tip && c.$tip.is(":visible") ? void (c.hoverState = "in") : (c || (c = new this.constructor(b.currentTarget, this.getDelegateOptions()), a(b.currentTarget).data("bs." + this.type, c)), clearTimeout(c.timeout), c.hoverState = "in", c.options.delay && c.options.delay.show ? void (c.timeout = setTimeout(function () {
         "in" == c.hoverState && c.show();
      }, c.options.delay.show)) : c.show());
   }, c.prototype.leave = function (b) {
      var c = b instanceof this.constructor ? b : a(b.currentTarget).data("bs." + this.type);return c || (c = new this.constructor(b.currentTarget, this.getDelegateOptions()), a(b.currentTarget).data("bs." + this.type, c)), clearTimeout(c.timeout), c.hoverState = "out", c.options.delay && c.options.delay.hide ? void (c.timeout = setTimeout(function () {
         "out" == c.hoverState && c.hide();
      }, c.options.delay.hide)) : c.hide();
   }, c.prototype.show = function () {
      var b = a.Event("show.bs." + this.type);if (this.hasContent() && this.enabled) {
         this.$element.trigger(b);var d = a.contains(this.$element[0].ownerDocument.documentElement, this.$element[0]);if (b.isDefaultPrevented() || !d) return;var e = this,
             f = this.tip(),
             g = this.getUID(this.type);this.setContent(), f.attr("id", g), this.$element.attr("aria-describedby", g), this.options.animation && f.addClass("fade");var h = "function" == typeof this.options.placement ? this.options.placement.call(this, f[0], this.$element[0]) : this.options.placement,
             i = /\s?auto?\s?/i,
             j = i.test(h);j && (h = h.replace(i, "") || "top"), f.detach().css({ top: 0, left: 0, display: "block" }).addClass(h).data("bs." + this.type, this), this.options.container ? f.appendTo(this.options.container) : f.insertAfter(this.$element);var k = this.getPosition(),
             l = f[0].offsetWidth,
             m = f[0].offsetHeight;if (j) {
            var n = h,
                o = this.options.container ? a(this.options.container) : this.$element.parent(),
                p = this.getPosition(o);h = "bottom" == h && k.bottom + m > p.bottom ? "top" : "top" == h && k.top - m < p.top ? "bottom" : "right" == h && k.right + l > p.width ? "left" : "left" == h && k.left - l < p.left ? "right" : h, f.removeClass(n).addClass(h);
         }var q = this.getCalculatedOffset(h, k, l, m);this.applyPlacement(q, h);var r = function r() {
            var a = e.hoverState;e.$element.trigger("shown.bs." + e.type), e.hoverState = null, "out" == a && e.leave(e);
         };a.support.transition && this.$tip.hasClass("fade") ? f.one("bsTransitionEnd", r).emulateTransitionEnd(c.TRANSITION_DURATION) : r();
      }
   }, c.prototype.applyPlacement = function (b, c) {
      var d = this.tip(),
          e = d[0].offsetWidth,
          f = d[0].offsetHeight,
          g = parseInt(d.css("margin-top"), 10),
          h = parseInt(d.css("margin-left"), 10);isNaN(g) && (g = 0), isNaN(h) && (h = 0), b.top = b.top + g, b.left = b.left + h, a.offset.setOffset(d[0], a.extend({ using: function using(a) {
            d.css({ top: Math.round(a.top), left: Math.round(a.left) });
         } }, b), 0), d.addClass("in");var i = d[0].offsetWidth,
          j = d[0].offsetHeight;"top" == c && j != f && (b.top = b.top + f - j);var k = this.getViewportAdjustedDelta(c, b, i, j);k.left ? b.left += k.left : b.top += k.top;var l = /top|bottom/.test(c),
          m = l ? 2 * k.left - e + i : 2 * k.top - f + j,
          n = l ? "offsetWidth" : "offsetHeight";d.offset(b), this.replaceArrow(m, d[0][n], l);
   }, c.prototype.replaceArrow = function (a, b, c) {
      this.arrow().css(c ? "left" : "top", 50 * (1 - a / b) + "%").css(c ? "top" : "left", "");
   }, c.prototype.setContent = function () {
      var a = this.tip(),
          b = this.getTitle();a.find(".tooltip-inner")[this.options.html ? "html" : "text"](b), a.removeClass("fade in top bottom left right");
   }, c.prototype.hide = function (b) {
      function d() {
         "in" != e.hoverState && f.detach(), e.$element.removeAttr("aria-describedby").trigger("hidden.bs." + e.type), b && b();
      }var e = this,
          f = this.tip(),
          g = a.Event("hide.bs." + this.type);return this.$element.trigger(g), g.isDefaultPrevented() ? void 0 : (f.removeClass("in"), a.support.transition && this.$tip.hasClass("fade") ? f.one("bsTransitionEnd", d).emulateTransitionEnd(c.TRANSITION_DURATION) : d(), this.hoverState = null, this);
   }, c.prototype.fixTitle = function () {
      var a = this.$element;(a.attr("title") || "string" != typeof a.attr("data-original-title")) && a.attr("data-original-title", a.attr("title") || "").attr("title", "");
   }, c.prototype.hasContent = function () {
      return this.getTitle();
   }, c.prototype.getPosition = function (b) {
      b = b || this.$element;var c = b[0],
          d = "BODY" == c.tagName,
          e = c.getBoundingClientRect();null == e.width && (e = a.extend({}, e, { width: e.right - e.left, height: e.bottom - e.top }));var f = d ? { top: 0, left: 0 } : b.offset(),
          g = { scroll: d ? document.documentElement.scrollTop || document.body.scrollTop : b.scrollTop() },
          h = d ? { width: a(window).width(), height: a(window).height() } : null;return a.extend({}, e, g, h, f);
   }, c.prototype.getCalculatedOffset = function (a, b, c, d) {
      return "bottom" == a ? { top: b.top + b.height, left: b.left + b.width / 2 - c / 2 } : "top" == a ? { top: b.top - d, left: b.left + b.width / 2 - c / 2 } : "left" == a ? { top: b.top + b.height / 2 - d / 2, left: b.left - c } : { top: b.top + b.height / 2 - d / 2, left: b.left + b.width };
   }, c.prototype.getViewportAdjustedDelta = function (a, b, c, d) {
      var e = { top: 0, left: 0 };if (!this.$viewport) return e;var f = this.options.viewport && this.options.viewport.padding || 0,
          g = this.getPosition(this.$viewport);if (/right|left/.test(a)) {
         var h = b.top - f - g.scroll,
             i = b.top + f - g.scroll + d;h < g.top ? e.top = g.top - h : i > g.top + g.height && (e.top = g.top + g.height - i);
      } else {
         var j = b.left - f,
             k = b.left + f + c;j < g.left ? e.left = g.left - j : k > g.width && (e.left = g.left + g.width - k);
      }return e;
   }, c.prototype.getTitle = function () {
      var a,
          b = this.$element,
          c = this.options;return a = b.attr("data-original-title") || ("function" == typeof c.title ? c.title.call(b[0]) : c.title);
   }, c.prototype.getUID = function (a) {
      do {
         a += ~~(1e6 * Math.random());
      } while (document.getElementById(a));return a;
   }, c.prototype.tip = function () {
      return this.$tip = this.$tip || a(this.options.template);
   }, c.prototype.arrow = function () {
      return this.$arrow = this.$arrow || this.tip().find(".tooltip-arrow");
   }, c.prototype.enable = function () {
      this.enabled = !0;
   }, c.prototype.disable = function () {
      this.enabled = !1;
   }, c.prototype.toggleEnabled = function () {
      this.enabled = !this.enabled;
   }, c.prototype.toggle = function (b) {
      var c = this;b && (c = a(b.currentTarget).data("bs." + this.type), c || (c = new this.constructor(b.currentTarget, this.getDelegateOptions()), a(b.currentTarget).data("bs." + this.type, c))), c.tip().hasClass("in") ? c.leave(c) : c.enter(c);
   }, c.prototype.destroy = function () {
      var a = this;clearTimeout(this.timeout), this.hide(function () {
         a.$element.off("." + a.type).removeData("bs." + a.type);
      });
   };var d = a.fn.tooltip;a.fn.tooltip = b, a.fn.tooltip.Constructor = c, a.fn.tooltip.noConflict = function () {
      return a.fn.tooltip = d, this;
   };
}(jQuery), +function (a) {
   "use strict";
   function b(b) {
      return this.each(function () {
         var d = a(this),
             e = d.data("bs.popover"),
             f = "object" == (typeof b === "undefined" ? "undefined" : _typeof(b)) && b,
             g = f && f.selector;(e || "destroy" != b) && (g ? (e || d.data("bs.popover", e = {}), e[g] || (e[g] = new c(this, f))) : e || d.data("bs.popover", e = new c(this, f)), "string" == typeof b && e[b]());
      });
   }var c = function c(a, b) {
      this.init("popover", a, b);
   };if (!a.fn.tooltip) throw new Error("Popover requires tooltip.js");c.VERSION = "3.3.1", c.DEFAULTS = a.extend({}, a.fn.tooltip.Constructor.DEFAULTS, { placement: "right", trigger: "click", content: "", template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>' }), c.prototype = a.extend({}, a.fn.tooltip.Constructor.prototype), c.prototype.constructor = c, c.prototype.getDefaults = function () {
      return c.DEFAULTS;
   }, c.prototype.setContent = function () {
      var a = this.tip(),
          b = this.getTitle(),
          c = this.getContent();a.find(".popover-title")[this.options.html ? "html" : "text"](b), a.find(".popover-content").children().detach().end()[this.options.html ? "string" == typeof c ? "html" : "append" : "text"](c), a.removeClass("fade top bottom left right in"), a.find(".popover-title").html() || a.find(".popover-title").hide();
   }, c.prototype.hasContent = function () {
      return this.getTitle() || this.getContent();
   }, c.prototype.getContent = function () {
      var a = this.$element,
          b = this.options;return a.attr("data-content") || ("function" == typeof b.content ? b.content.call(a[0]) : b.content);
   }, c.prototype.arrow = function () {
      return this.$arrow = this.$arrow || this.tip().find(".arrow");
   }, c.prototype.tip = function () {
      return this.$tip || (this.$tip = a(this.options.template)), this.$tip;
   };var d = a.fn.popover;a.fn.popover = b, a.fn.popover.Constructor = c, a.fn.popover.noConflict = function () {
      return a.fn.popover = d, this;
   };
}(jQuery), +function (a) {
   "use strict";
   function b(c, d) {
      var e = a.proxy(this.process, this);this.$body = a("body"), this.$scrollElement = a(a(c).is("body") ? window : c), this.options = a.extend({}, b.DEFAULTS, d), this.selector = (this.options.target || "") + " .nav li > a", this.offsets = [], this.targets = [], this.activeTarget = null, this.scrollHeight = 0, this.$scrollElement.on("scroll.bs.scrollspy", e), this.refresh(), this.process();
   }function c(c) {
      return this.each(function () {
         var d = a(this),
             e = d.data("bs.scrollspy"),
             f = "object" == (typeof c === "undefined" ? "undefined" : _typeof(c)) && c;e || d.data("bs.scrollspy", e = new b(this, f)), "string" == typeof c && e[c]();
      });
   }b.VERSION = "3.3.1", b.DEFAULTS = { offset: 10 }, b.prototype.getScrollHeight = function () {
      return this.$scrollElement[0].scrollHeight || Math.max(this.$body[0].scrollHeight, document.documentElement.scrollHeight);
   }, b.prototype.refresh = function () {
      var b = "offset",
          c = 0;a.isWindow(this.$scrollElement[0]) || (b = "position", c = this.$scrollElement.scrollTop()), this.offsets = [], this.targets = [], this.scrollHeight = this.getScrollHeight();var d = this;this.$body.find(this.selector).map(function () {
         var d = a(this),
             e = d.data("target") || d.attr("href"),
             f = /^#./.test(e) && a(e);return f && f.length && f.is(":visible") && [[f[b]().top + c, e]] || null;
      }).sort(function (a, b) {
         return a[0] - b[0];
      }).each(function () {
         d.offsets.push(this[0]), d.targets.push(this[1]);
      });
   }, b.prototype.process = function () {
      var a,
          b = this.$scrollElement.scrollTop() + this.options.offset,
          c = this.getScrollHeight(),
          d = this.options.offset + c - this.$scrollElement.height(),
          e = this.offsets,
          f = this.targets,
          g = this.activeTarget;if (this.scrollHeight != c && this.refresh(), b >= d) return g != (a = f[f.length - 1]) && this.activate(a);if (g && b < e[0]) return this.activeTarget = null, this.clear();for (a = e.length; a--;) {
         g != f[a] && b >= e[a] && (!e[a + 1] || b <= e[a + 1]) && this.activate(f[a]);
      }
   }, b.prototype.activate = function (b) {
      this.activeTarget = b, this.clear();var c = this.selector + '[data-target="' + b + '"],' + this.selector + '[href="' + b + '"]',
          d = a(c).parents("li").addClass("active");d.parent(".dropdown-menu").length && (d = d.closest("li.dropdown").addClass("active")), d.trigger("activate.bs.scrollspy");
   }, b.prototype.clear = function () {
      a(this.selector).parentsUntil(this.options.target, ".active").removeClass("active");
   };var d = a.fn.scrollspy;a.fn.scrollspy = c, a.fn.scrollspy.Constructor = b, a.fn.scrollspy.noConflict = function () {
      return a.fn.scrollspy = d, this;
   }, a(window).on("load.bs.scrollspy.data-api", function () {
      a('[data-spy="scroll"]').each(function () {
         var b = a(this);c.call(b, b.data());
      });
   });
}(jQuery), +function (a) {
   "use strict";
   function b(b) {
      return this.each(function () {
         var d = a(this),
             e = d.data("bs.tab");e || d.data("bs.tab", e = new c(this)), "string" == typeof b && e[b]();
      });
   }var c = function c(b) {
      this.element = a(b);
   };c.VERSION = "3.3.1", c.TRANSITION_DURATION = 150, c.prototype.show = function () {
      var b = this.element,
          c = b.closest("ul:not(.dropdown-menu)"),
          d = b.data("target");if (d || (d = b.attr("href"), d = d && d.replace(/.*(?=#[^\s]*$)/, "")), !b.parent("li").hasClass("active")) {
         var e = c.find(".active:last a"),
             f = a.Event("hide.bs.tab", { relatedTarget: b[0] }),
             g = a.Event("show.bs.tab", { relatedTarget: e[0] });if (e.trigger(f), b.trigger(g), !g.isDefaultPrevented() && !f.isDefaultPrevented()) {
            var h = a(d);this.activate(b.closest("li"), c), this.activate(h, h.parent(), function () {
               e.trigger({ type: "hidden.bs.tab", relatedTarget: b[0] }), b.trigger({ type: "shown.bs.tab", relatedTarget: e[0] });
            });
         }
      }
   }, c.prototype.activate = function (b, d, e) {
      function f() {
         g.removeClass("active").find("> .dropdown-menu > .active").removeClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded", !1), b.addClass("active").find('[data-toggle="tab"]').attr("aria-expanded", !0), h ? (b[0].offsetWidth, b.addClass("in")) : b.removeClass("fade"), b.parent(".dropdown-menu") && b.closest("li.dropdown").addClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded", !0), e && e();
      }var g = d.find("> .active"),
          h = e && a.support.transition && (g.length && g.hasClass("fade") || !!d.find("> .fade").length);g.length && h ? g.one("bsTransitionEnd", f).emulateTransitionEnd(c.TRANSITION_DURATION) : f(), g.removeClass("in");
   };var d = a.fn.tab;a.fn.tab = b, a.fn.tab.Constructor = c, a.fn.tab.noConflict = function () {
      return a.fn.tab = d, this;
   };var e = function e(c) {
      c.preventDefault(), b.call(a(this), "show");
   };a(document).on("click.bs.tab.data-api", '[data-toggle="tab"]', e).on("click.bs.tab.data-api", '[data-toggle="pill"]', e);
}(jQuery), +function (a) {
   "use strict";
   function b(b) {
      return this.each(function () {
         var d = a(this),
             e = d.data("bs.affix"),
             f = "object" == (typeof b === "undefined" ? "undefined" : _typeof(b)) && b;e || d.data("bs.affix", e = new c(this, f)), "string" == typeof b && e[b]();
      });
   }var c = function c(b, d) {
      this.options = a.extend({}, c.DEFAULTS, d), this.$target = a(this.options.target).on("scroll.bs.affix.data-api", a.proxy(this.checkPosition, this)).on("click.bs.affix.data-api", a.proxy(this.checkPositionWithEventLoop, this)), this.$element = a(b), this.affixed = this.unpin = this.pinnedOffset = null, this.checkPosition();
   };c.VERSION = "3.3.1", c.RESET = "affix affix-top affix-bottom", c.DEFAULTS = { offset: 0, target: window }, c.prototype.getState = function (a, b, c, d) {
      var e = this.$target.scrollTop(),
          f = this.$element.offset(),
          g = this.$target.height();if (null != c && "top" == this.affixed) return c > e ? "top" : !1;if ("bottom" == this.affixed) return null != c ? e + this.unpin <= f.top ? !1 : "bottom" : a - d >= e + g ? !1 : "bottom";var h = null == this.affixed,
          i = h ? e : f.top,
          j = h ? g : b;return null != c && c >= i ? "top" : null != d && i + j >= a - d ? "bottom" : !1;
   }, c.prototype.getPinnedOffset = function () {
      if (this.pinnedOffset) return this.pinnedOffset;this.$element.removeClass(c.RESET).addClass("affix");var a = this.$target.scrollTop(),
          b = this.$element.offset();return this.pinnedOffset = b.top - a;
   }, c.prototype.checkPositionWithEventLoop = function () {
      setTimeout(a.proxy(this.checkPosition, this), 1);
   }, c.prototype.checkPosition = function () {
      if (this.$element.is(":visible")) {
         var b = this.$element.height(),
             d = this.options.offset,
             e = d.top,
             f = d.bottom,
             g = a("body").height();"object" != (typeof d === "undefined" ? "undefined" : _typeof(d)) && (f = e = d), "function" == typeof e && (e = d.top(this.$element)), "function" == typeof f && (f = d.bottom(this.$element));var h = this.getState(g, b, e, f);if (this.affixed != h) {
            null != this.unpin && this.$element.css("top", "");var i = "affix" + (h ? "-" + h : ""),
                j = a.Event(i + ".bs.affix");if (this.$element.trigger(j), j.isDefaultPrevented()) return;this.affixed = h, this.unpin = "bottom" == h ? this.getPinnedOffset() : null, this.$element.removeClass(c.RESET).addClass(i).trigger(i.replace("affix", "affixed") + ".bs.affix");
         }"bottom" == h && this.$element.offset({ top: g - b - f });
      }
   };var d = a.fn.affix;a.fn.affix = b, a.fn.affix.Constructor = c, a.fn.affix.noConflict = function () {
      return a.fn.affix = d, this;
   }, a(window).on("load", function () {
      a('[data-spy="affix"]').each(function () {
         var c = a(this),
             d = c.data();d.offset = d.offset || {}, null != d.offsetBottom && (d.offset.bottom = d.offsetBottom), null != d.offsetTop && (d.offset.top = d.offsetTop), b.call(c, d);
      });
   });
}(jQuery);
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(0), __webpack_require__(0)))

/***/ }),

/***/ 41:
/***/ (function(module, exports) {

/* WEBPACK VAR INJECTION */(function(__webpack_amd_options__) {/* globals __webpack_amd_options__ */
module.exports = __webpack_amd_options__;

/* WEBPACK VAR INJECTION */}.call(exports, {}))

/***/ }),

/***/ 44:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(13);
__webpack_require__(11);
module.exports = __webpack_require__(12);


/***/ })

/******/ });