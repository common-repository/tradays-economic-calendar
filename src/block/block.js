/**
 * BLOCK: tradays-block
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import './editor.scss';
import Icon from 'svg-react-loader!./icon.svg';
import Inspector from './inspector.js';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { RawHTML, Fragment } = wp.element;
const { SandBox } = wp.components;

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
registerBlockType( 'tradays-economic-calendar/calendar-block', {
	title: __( 'Tradays', 'tradays' ), // Block title.
	description: __( 'Display news releases and indicators relating to the world\'s largest economies', 'tradays' ),
	icon: <Icon viewBox="0 0 20 20" />,
	category: 'widgets',
	keywords: [
		__( 'tradays', 'tradays' ),
		__( 'economic calendar', 'tradays' ),
	],
	supports: {
		customClassName: false,
		className: false,
		html: false,
	},
	attributes: {
		id: {
			type: 'string',
			default: 'economicCalendarWidget',
		},
		width: {
			type: 'string',
			default: '100%',
		},
		height: {
			type: 'string',
			default: '300px',
		},
		autoSize: {
			type: 'boolean',
			default: false,
		},
		mode: {
			type: 'string',
			default: '2',
		},
		lang: {
			type: 'string',
			default: 'def',
		},
		dateformat: {
			type: 'string',
			default: 'DMY',
		},
	},

	edit: function( props ) {
		const { attributes } = props;
		const html = buildHTML( attributes, true );
		return (
			<Fragment>
				<Inspector { ...props } />
				<SandBox key={ JSON.stringify( attributes ) } html={ html } />
			</Fragment>
		);
	},

	save: function( props ) {
		return (
			<RawHTML>
				{ buildHTML( props.attributes ) }
			</RawHTML>
		);
	},
} );

function buildHTML( { id, width, height, lang, dateformat, mode, autoSize }, provideScript = false ) {
	let output = '';
	let options = {
		id,
		width,
		height,
		dateformat,
		mode,
	};

	if ( lang !== 'def' ) {
		options = { ...options, lang };
	}

	if ( autoSize ) {
		options = {
			...options,
			width: '100%',
			height: '100%',
		};
	}

	const optionsStr = JSON.stringify( options );

	if ( provideScript ) {
		output += '<script type="text/javascript" src="https://c.mql5.com/js/widgets/calendar/widget.js?6"></script>';
	}

	output += '<div id="' + id + '"></div><script type="text/javascript">new economicCalendar(' + optionsStr + ')</script>';

	return output;
}
