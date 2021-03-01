/**
 * Foreach polyfill for IE
 *
 * @package roxtar
 */

if ( ! Object.getOwnPropertyDescriptor( NodeList.prototype, 'forEach' ) ) {
	Object.defineProperty( NodeList.prototype, 'forEach', Object.getOwnPropertyDescriptor( Array.prototype, 'forEach' ) );
}
