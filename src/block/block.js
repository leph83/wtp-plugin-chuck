/**
 * BLOCK: wtp-plugin-block
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import './editor.scss';
import './style.scss';
import { InnerBlocks } from '@wordpress/block-editor';

const { __ } = wp.i18n; // Import __() from wp.i18n
const { registerBlockType } = wp.blocks; // Import registerBlockType() from wp.blocks
// const ALLOWED_BLOCKS = [ 'core/image', 'core/paragraph' ];

// const TEMPLATE = [ 
// 	[ 
// 		'wtp/block-media', {}, [
// 			[ 'core/image' ]
// 		]
// 	],
// 	[
// 		'wtp/block-content', {}, [
// 			[ 
// 				'wtp/block-heading', {}, [
// 					[ 'core/heading', { level: 1 } ],
// 				],
// 			],
// 			[ 
// 				'wtp/block-description', {}, [
// 					[ 'core/paragraph', { placeholder: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr...' } ],
// 				],
// 			],
// 			[ 
// 				'wtp/block-links', {}, [
// 					[ 'core/button' ],
// 				],
// 			],
// 		],
// 	],
// ];


const TEMPLATE = [ 
	[ 
		'wtp/block-media', {}, []
	],
	[
		'wtp/block-content', {}, []
	],
];



/**
 * Register: aa Gutenberg Block.
 *
 * Registers a new block provided a unique name and an object defining its
 * behavior. Once registered, the block is made editor as an option to any
 * editor interface where blocks are implemented.
 *
 * @link https://wordpress.org/gutenberg/handbook/block-api/
 * @param  {string}   name     Block name.
 * @param  {Object}   settings Block settings.
 * @return {?WPBlock}          The block, if it has been successfully
 *                             registered; otherwise `undefined`.
 */
registerBlockType( 'wtp/block', {
	// Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
	title: __( 'WTP Block' ), // Block title.
	icon: 'grid-view', // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	category: 'common', // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
	keywords: [
		__( 'WTP' ),
		__( 'Block' ),
	],
	supports: { // Hey WP, I want to use your alignment toolbar!
		align: true,
	},

	/**
	 * The edit function describes the structure of your block in the context of the editor.
	 * This represents what the editor will render when the block is used.
	 *
	 * The "edit" property must be a valid function.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
	 *
	 * @param {Object} props Props.
	 * @returns {Mixed} JSX Component.
	 */
	edit: ( props ) => {
		// Creates a <p class='wp-block-cgb-block-wtp-plugin-block'></p>.
		return (
			<div className={ props.className }>
				<InnerBlocks
					template={ TEMPLATE }
					templateLock='insert'
				/>
			</div>
		);
	},

	/**
	 * The save function defines the way in which the different attributes should be combined
	 * into the final markup, which is then serialized by Gutenberg into post_content.
	 *
	 * The "save" property must be specified and must be a valid function.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
	 *
	 * @param {Object} props Props.
	 * @returns {Mixed} JSX Frontend HTML.
	 */
	save: ( props ) => {
		return (
			<InnerBlocks.Content />
		)
	},
} );
