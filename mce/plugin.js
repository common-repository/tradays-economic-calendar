( function() {
	tinymce.create( 'tinymce.plugins.tradays', {
		init: function( ed, url ) {
			const options = {
				langs: [
					{ value: 'def', text: ed.getLang( 'tradaysEconomicCalendar.langs.pageLang' ) },
					{ value: 'en', text: 'English' },
					{ value: 'ru', text: 'Русский' },
					{ value: 'de', text: 'Deutsch' },
					{ value: 'pt', text: 'Português' },
					{ value: 'es', text: 'Español' },
					{ value: 'zh', text: '中文' },
					{ value: 'ja', text: '日本語' },
					{ value: 'ar', text: 'العربية' },
					{ value: 'tr', text: 'Türkçe' },
				],
				dateformats: [
					{ value: 'DMY', text: 'DD.MM.YYYY' },
					{ value: 'MDY', text: 'MM.DD.YYYY' },
					{ value: 'YMD', text: 'YYYY.MM.DD' },
				],
				modes: [
					{ value: '1', text: ed.getLang( 'tradaysEconomicCalendar.modes.currDay' ) },
					{ value: '2', text: ed.getLang( 'tradaysEconomicCalendar.modes.currWeek' ) },
				],
			};

			ed.addButton( 'tradaysEconomicCalendar.insertShortcode', {
				title: ed.getLang( 'tradaysEconomicCalendar.button.title' ),
				cmd: 'tradaysEconomicCalendar.insertShortcode.popup',
				image: url + '/icon.svg',
			} );

			ed.addCommand( 'tradaysEconomicCalendar.insertShortcode.popup', function() {
				ed.windowManager.open( {
					title: ed.getLang( 'tradaysEconomicCalendar.modal.title' ),
					body: [
						{
							type: 'textbox',
							name: 'width',
							label: ed.getLang( 'tradaysEconomicCalendar.labels.width' ),
							value: '100%',
						},
						{
							type: 'textbox',
							name: 'height',
							label: ed.getLang( 'tradaysEconomicCalendar.labels.height' ),
							value: '600px',
						},
						{
							type: 'checkbox',
							name: 'autosize',
							label: ed.getLang( 'tradaysEconomicCalendar.labels.autosize' ),
							onchange: function( e ) {
								const checked = e.control.checked();
								this.getRoot().find( '#width' )[ 0 ].disabled( checked );
								this.getRoot().find( '#height' )[ 0 ].disabled( checked );
							},
						},
						{
							type: 'spacer',
						},
						{
							type: 'listbox',
							name: 'mode',
							label: ed.getLang( 'tradaysEconomicCalendar.labels.mode' ),
							value: '2',
							values: options.modes,
						},
						{
							type: 'spacer',
						},
						{
							type: 'listbox',
							label: ed.getLang( 'tradaysEconomicCalendar.labels.language' ),
							name: 'lang',
							values: options.langs,
						},
						{
							type: 'spacer',
						},
						{
							type: 'listbox',
							label: ed.getLang( 'tradaysEconomicCalendar.labels.dateformat' ),
							name: 'dateformat',
							values: options.dateformats,
						},
					],
					onsubmit: function( e ) {
						if ( e.data.autosize ) {
							e.data.width = '100%';
							e.data.height = '100%';
						}

						let shortcode =
              '[tradays width="' + e.data.width + '" ' +
              'height="' + e.data.height + '" ' +
              'mode="' + e.data.mode + '"';

						if ( e.data.lang !== 'def' ) {
							shortcode += ' lang="' + e.data.lang + '"';
						}

						shortcode += ' dateformat="' + e.data.dateformat + '" ]';

						ed.insertContent( shortcode );
					},
				} );
			} );
		},

		createControl: function() {
			return null;
		},

		getInfo: function() {
			return {
				longname: 'Tradays Economic Calendar',
				author: 'MQL5 Ltd.',
				authorurl: 'http://mql5.com',
				version: '1.0.0',
			};
		},
	} );

	tinymce.PluginManager.add(
		'tradays',
		tinymce.plugins.tradays
	);
}() );
