import options from '../options.json';

const { __ } = wp.i18n;
const { Component } = wp.element;
const { PanelBody, TextControl, ToggleControl, Disabled, RadioControl, SelectControl } = wp.components;
const { InspectorControls } = wp.editor;

function translateLabels( items ) {
	return items.map( item =>
		( {
			...item,
			label: __( item.label, 'tradays' ),
		} )
	);
}

const langs = translateLabels( options.langs );
const modes = translateLabels( options.modes );

const InputGroup = ( { disabled, children } ) => {
	if ( disabled ) {
		return (
			<Disabled>
				{ children }
			</Disabled>
		);
	}
	return (
		<div>
			{ children }
		</div>
	);
};

export default class Inspector extends Component {
	constructor() {
		super( ...arguments );
		this.toggleAutoSize = this.toggleAutoSize.bind( this );
	}

	componentDidMount() {
		this.props.setAttributes( { id: 'economicCalendarWidget-' + Date.now() } );
	}

	render() {
		const { attributes, setAttributes } = this.props;

		return (
			<InspectorControls>
				<PanelBody title={ __( 'Tradays Settings', 'tradays' ) }>
					<div style={ { marginBottom: '26px' } }>
						<InputGroup disabled={ attributes.autoSize }>
							<TextControl
								required
								label={ __( 'Width', 'tradays' ) + ':' }
								value={ attributes.width }
								onChange={ ( width ) => setAttributes( { width } ) }
							/>
							<TextControl
								required
								label={ __( 'Height', 'tradays' ) + ':' }
								value={ attributes.height }
								onChange={ ( height ) => setAttributes( { height } ) }
							/>
						</InputGroup>
					</div>
					<ToggleControl
						label={ __( 'Auto Size', 'tradays' ) }
						checked={ attributes.autoSize }
						onChange={ this.toggleAutoSize }
					/>
					<RadioControl
						label={ __( 'Mode', 'tradays' ) + ':' }
						selected={ attributes.mode }
						onChange={ ( mode ) => {
							setAttributes( { mode } );
						} }
						options={ modes }
					/>
					<SelectControl
						label={ __( 'Language', 'tradays' ) + ':' }
						value={ attributes.lang }
						onChange={ ( lang ) => {
							setAttributes( { lang } );
						} }
						options={ langs }
					/>
					<SelectControl
						label={ __( 'Date Format', 'tradays' ) + ':' }
						value={ attributes.dateformat }
						onChange={ ( dateformat ) => {
							setAttributes( { dateformat } );
						} }
						options={ options.dateformats }
					/>
				</PanelBody>
			</InspectorControls>
		);
	}

	toggleAutoSize( autoSize ) {
		const { setAttributes } = this.props;

		setAttributes( { autoSize } );
	}
}
