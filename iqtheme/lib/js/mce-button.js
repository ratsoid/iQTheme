(function() {
    tinymce.PluginManager.add('iq_mce_button', function( editor, url ) {
        editor.addButton( 'columns_mce_button', {
            text: 'Columns',
            icon: 'icon columns',
            onclick: function() {
                editor.insertContent('<p><div class="flex-container"></div></p><br />');
            }
        });
        editor.addButton( 'iq_mce_button', {
            text: 'IQ Extras',
            icon: false,
            type: 'menubutton',
            menu: [
                {
                    text: 'Add-ons',
                    menu: [
                        {
                            text: 'Note',
                            onclick: function() {
                                editor.windowManager.open( {
                                    title: 'Add Note',
                                    body: [
                                        {
                                            type: 'textbox',
                                            name: 'textboxName',
                                            label: 'Title',
                                            value: 'Note Title'
                                        },
                                        {
                                            type: 'textbox',
                                            name: 'multilineName',
                                            label: 'Content',
                                            value: 'You can say a lot of stuff in here and add more styling in the editor :)',
                                            multiline: true,
                                            minWidth: 300,
                                            minHeight: 100
                                        },
                                        {
                                            type: 'listbox',
                                            name: 'listboxName',
                                            label: 'Color Palette',
                                            'values': [
                                                {text: 'Red', value: 'iqnote-red'},
                                                {text: 'Green', value: 'iqnote-green'},
                                                {text: 'Blue', value: 'iqnote-blue'},
                                                {text: 'Dark', value: 'iqnote-dark'}
                                            ]
                                        }
                                    ],
                                    onsubmit: function( e ) {
//                                        editor.insertContent( '[random_shortcode textbox="' + e.data.textboxName + '" multiline="" listbox="' + e.data.listboxName + '"]');
                                        editor.insertContent( '<div class="iqnote ' + e.data.listboxName + '"><div class="iqnote-title">' + e.data.textboxName + '</div><div class="iqnote-content"><p>' + e.data.multilineName + '</p></div></div>&nbsp;');
                                    }
                                });
                            }
                        },
                        {
                            text: 'Box',
                            onclick: function() {
                                editor.windowManager.open( {
                                    title: 'Add Box',
                                    body: [
                                        {
                                            type: 'textbox',
                                            name: 'boxWidth',
                                            label: 'Width (px or %)',
                                            value: '400px'
                                        },
                                        {
                                            type: 'textbox',
                                            name: 'boxHeight',
                                            label: 'Height (px or %)',
                                            value: '280px'
                                        },
                                        {
                                            type: 'textbox',
                                            name: 'boxTitle',
                                            label: 'Title',
                                            value: 'You can edit me later'
                                        },
                                        {
                                            type: 'textbox',
                                            name: 'boxContent',
                                            label: 'Content',
                                            value: 'You can say a lot of stuff in here and add more styling in the editor :)',
                                            multiline: true,
                                            minWidth: 300,
                                            minHeight: 100
                                        },
                                        {
                                            type: 'listbox',
                                            name: 'boxColor',
                                            label: 'Background Color',
                                            'values': [
                                                {text: 'White', value: ''},
                                                {text: 'Red', value: 'box-red'},
                                                {text: 'Green', value: 'box-green'},
                                                {text: 'Blue', value: 'box-blue'},
                                                {text: 'Dark', value: 'box-dark'}
                                            ]
                                        }
                                    ],
                                    onsubmit: function( e ) {
                                        editor.insertContent( '<div style="width: ' + e.data.boxWidth + '; height: ' + e.data.boxHeight + ';" class="box ' + e.data.boxColor + '"><h2>' + e.data.boxTitle + '</h2><p>' + e.data.boxContent + '</p></div>&nbsp;');
                                    }
                                });
                            }
                        },
                        {
                            text: 'Pricing Table',
                            onclick: function() {
                                editor.windowManager.open( {
                                    title: 'Add Pricing Table',
                                    body: [
                                        {
                                            type: 'textbox',
                                            name: 'ptName',
                                            label: 'Plan',
                                            value: 'Plan Title'
                                        },
                                        {
                                            type: 'textbox',
                                            name: 'ptValue',
                                            label: 'Value',
                                            value: '$100'
                                        },
                                        {
                                            type: 'textbox',
                                            name: 'ptLink',
                                            label: 'Link',
                                            value: 'http://'
                                        },
                                        {
                                            type: 'listbox',
                                            name: 'ptColor',
                                            label: 'Color Palette',
                                            'values': [
                                                {text: 'Red', value: 'pt-red'},
                                                {text: 'Green', value: 'pt-green'},
                                                {text: 'Blue', value: 'pt-blue'},
                                                {text: 'Dark', value: 'pt-dark'}
                                            ]
                                        },
                                        {
                                            type: 'textbox',
                                            name: 'ptWidth',
                                            label: 'Width (px or %)',
                                            value: '280px'
                                        },
                                        {
                                            type: 'textbox',
                                            name: 'ptHeight',
                                            label: 'Height (px)',
                                            value: 'auto'
                                        },
                                        {
                                            type: 'textbox',
                                            name: 'ptMargin',
                                            label: 'Margins (px)',
                                            value: '20px'
                                        },
                                        {
                                            type: 'listbox',
                                            name: 'ptVertical',
                                            label: 'Vertical Align',
                                            'values': [
                                                {text: 'Top', value: 'top'},
                                                {text: 'Middle', value: 'middle'},
                                                {text: 'Bottom', value: 'bottom'}
                                            ]
                                        }
                                    ],
                                    onsubmit: function( e ) {
//                                        editor.insertContent( '[random_shortcode textbox="' + e.data.textboxName + '" multiline="" listbox="' + e.data.listboxName + '"]');
                                        editor.insertContent(
                                            '<div class="ptable ' + e.data.ptColor + '" style="width:' + e.data.ptWidth + '; height:' + e.data.ptHeight + '; margin: ' + e.data.ptMargin + ' 20px; vertical-align:' + e.data.ptVertical + ';"><div class="ptable-header"><div class="ptable-plan">' + e.data.ptName + '</div><div class="ptable-price"><p>' + e.data.ptValue + ' <span class="ptable-per"> /mo.</span></p><p class="ptable-desc">Description?</p></div></div><div class="ptable-content"><ul><li>Item</li><li>Item</li><li>Item</li><li>Item</li></ul><p class="aligncenter"><a class="ptable-button" href="' + e.data.ptLink + '">Buy!</a></p></div></div>&nbsp;');
                                    }
                                });
                            }
                        },
                        {
                            text: 'FAQ Dropdown',
                            onclick: function() {
                                editor.windowManager.open( {
                                    title: 'Add FAQ Item',
                                    body: [
                                        {
                                            type: 'textbox',
                                            name: 'faqTitle',
                                            label: 'Title',
                                            value: 'FAQ Title'
                                        },
                                        {
                                            type: 'textbox',
                                            name: 'faqContent',
                                            label: 'Content',
                                            value: 'You can add some text here or edit it afterwards',
                                            multiline: true,
                                            minWidth: 300,
                                            minHeight: 100
                                        },
                                        {
                                            type: 'listbox',
                                            name: 'faqClose',
                                            label: 'Autoclose',
                                            'values': [
                                                {text: 'Yes', value: 'autoclose'},
                                                {text: 'No', value: ''}
                                            ]
                                        },
                                        {
                                            type: 'listbox',
                                            name: 'faqColor',
                                            label: 'Button Color',
                                            'values': [
                                                {text: 'Theme Default', value: ''},
                                                {text: 'Red', value: 'iq-red'},
                                                {text: 'Green', value: 'iq-green'},
                                                {text: 'Blue', value: 'iq-blue'},
                                                {text: 'Dark', value: 'iq-dark'}
                                            ]
                                        }
                                    ],
                                    onsubmit: function( e ) {
                                        editor.insertContent(
                                            '<div class="iq-faq ' + e.data.faqColor + ' ' + e.data.faqClose + '"><h2><span class="faqExpand site-background">&nbsp;</span>' + e.data.faqTitle + '</h2><div class="iq-faqContent"><p>' + e.data.faqContent + '</p></div></div>&nbsp;');
                                    }
                                });
                            }
                        },
                        {
                            text: 'Countdown',
                            onclick: function() {
                                editor.windowManager.open( {
                                    title: 'Add Countdown',
                                    body: [
                                        {
                                            type: 'listbox',
                                            name: 'ctYear',
                                            label: 'Year',
                                            'values': [
                                                {text: '2014', value: '2014'},
                                                {text: '2015', value: '2015'},
                                                {text: '2016', value: '2016'},
                                                {text: '2017', value: '2017'},
                                                {text: '2018', value: '2018'},
                                                {text: '2019', value: '2019'},
                                                {text: '2020', value: '2020'}
                                            ]
                                        },
                                        {
                                            type: 'listbox',
                                            name: 'ctMonth',
                                            label: 'Month',
                                            'values': [
                                                {text: 'Jan', value: '01'},
                                                {text: 'Feb', value: '02'},
                                                {text: 'Mar', value: '03'},
                                                {text: 'Apr', value: '04'},
                                                {text: 'May', value: '05'},
                                                {text: 'Jun', value: '06'},
                                                {text: 'Jul', value: '07'},
                                                {text: 'Aug', value: '08'},
                                                {text: 'Sep', value: '09'},
                                                {text: 'Oct', value: '10'},
                                                {text: 'Nov', value: '11'},
                                                {text: 'Dec', value: '12'}
                                            ]
                                        },
                                        {
                                            type: 'listbox',
                                            name: 'ctDay',
                                            label: 'Day',
                                            'values': [
                                                {text: '01', value: '01'},
                                                {text: '02', value: '02'},
                                                {text: '03', value: '03'},
                                                {text: '04', value: '04'},
                                                {text: '05', value: '05'},
                                                {text: '06', value: '06'},
                                                {text: '07', value: '07'},
                                                {text: '08', value: '08'},
                                                {text: '09', value: '09'},
                                                {text: '10', value: '10'},
                                                {text: '11', value: '11'},
                                                {text: '12', value: '12'},
                                                {text: '13', value: '13'},
                                                {text: '14', value: '14'},
                                                {text: '15', value: '15'},
                                                {text: '16', value: '16'},
                                                {text: '17', value: '17'},
                                                {text: '18', value: '18'},
                                                {text: '19', value: '19'},
                                                {text: '20', value: '20'},
                                                {text: '21', value: '21'},
                                                {text: '22', value: '22'},
                                                {text: '23', value: '23'},
                                                {text: '24', value: '24'},
                                                {text: '25', value: '25'},
                                                {text: '26', value: '26'},
                                                {text: '27', value: '27'},
                                                {text: '28', value: '28'},
                                                {text: '29', value: '29'},
                                                {text: '30', value: '30'},
                                                {text: '31', value: '31'}
                                            ]
                                        },
                                        {
                                            type: 'listbox',
                                            name: 'ctUtc',
                                            label: 'UTC',
                                            'values': [
                                                {text: '00:00 (Accra, Abidjan, Casablanca, Dakar, Dublin, Lisbon, London)', value: '+0000'},
                                                {text: '-12:00', value: '-1200'},
                                                {text: '-11:00', value: '-1100'},
                                                {text: '-10:00 (Papeete, Honolulu)', value: '-1000'},
                                                {text: '-09:30', value: '-0930'},
                                                {text: '-09:90 (Anchorage)', value: '-0900'},
                                                {text: '-08:00 (Los Angeles, Vancouver, Tijuana)', value: '-0800'},
                                                {text: '-07:00 (Phoenix, Calgary, Ciudad Juárez, Mountain Time Zone)', value: '-0700'},
                                                {text: '-06:00 (Chicago, Guatemala City, Mexico City, San José, San Salvador, Tegucigalpa, Winnipeg, Central Time Zone)', value: '-0600'},
                                                {text: '-05:00 (New York, Lima, Toronto, Bogotá, Havana, Kingston, Eastern Time Zone)', value: '-0500'},
                                                {text: '-04:30 (Caracas)', value: '-0400'},
                                                {text: '-04:00 (Santiago, La Paz, San Juan de Puerto Rico, Manaus, Halifax, Atlantic Time Zone)', value: '-0400'},
                                                {text: '-03:30 (St. John\'s)', value: '-0330'},
                                                {text: '-03:00 (Buenos Aires, Montevideo, S?o Paulo)', value: '-0300'},
                                                {text: '-02:00', value: '-0200'},
                                                {text: '-01:00', value: '-0100'},
                                                {text: '00:00 (Accra, Abidjan, Casablanca, Dakar, Dublin, Lisbon, London)', value: '+0000'},
                                                {text: '+01:00 (Belgrade, Berlin, Brussels, Lagos, Madrid, Paris, Rome, Tunis, Vienna, Warsaw)', value: '+0100'},
                                                {text: '+02:00 (Athens, Sofia, Cairo, Kiev, Istanbul, Beirut, Helsinki, Jerusalem, Johannesburg, Bucharest)', value: '+0200'},
                                                {text: '+03:00 (Nairobi, Baghdad, Doha, Khartoum, Minsk, Riyadh)', value: '+0300'},
                                                {text: '+03:30 (Tehran)', value: '+0330'},
                                                {text: '+04:00 (Baku, Dubai, Moscow)', value: '+0400'},
                                                {text: '+04:30 (Kabul)', value: '+0430'},
                                                {text: '+05:00 (Karachi, Tashkent)', value: '+0500'},
                                                {text: '+05:30 (Colombo, Delhi)', value: '+0530'},
                                                {text: '+06:00 (Almaty, Dhaka, Yekaterinburg)', value: '+0600'},
                                                {text: '+06:30 (Yangon)', value: '+0630'},
                                                {text: '+07:00 (Jakarta, Bangkok, Novosibirsk, Hanoi)', value: '+0700'},
                                                {text: '+08:00 (Perth, Beijing, Manila, Singapore, Kuala Lumpur, Denpasar, Krasnoyarsk)', value: '+0800'},
                                                {text: '+08:45', value: '+0845'},
                                                {text: '+09:00 (Seoul, Tokyo, Pyongyang, Ambon, Irkutsk)', value: '+0900'},
                                                {text: '+09:30 (Adelaide)', value: '+0900'},
                                                {text: '+10:00 (Canberra, Yakutsk, Port Moresby)', value: '+1000'},
                                                {text: '+10:30', value: '+1030'},
                                                {text: '+11:00 (Vladivostok, Noumea)', value: '+1100'},
                                                {text: '+11:30', value: '+1130'},
                                                {text: '+12:00 (Auckland, Suva)', value: '+1200'},
                                                {text: '+12:45', value: '+1245'},
                                                {text: '+13:00', value: '+1300'},
                                                {text: '+14:00', value: '+1400'}
                                            ]
                                        },
                                        {
                                            type: 'textbox',
                                            name: 'ctTime',
                                            label: 'Time (HH:MM:SS)',
                                            value: '00:00:00'
                                        },
                                        {
                                            type: 'listbox',
                                            name: 'ctType',
                                            label: 'Design',
                                            'values': [
                                                {text: 'Black', value: 'ct-1'},
                                                {text: 'White', value: 'ct-2'},
                                                {text: 'Calendar', value: 'ct-3'},
                                                {text: 'None', value: 'ct-4'}
                                            ]
                                        }
                                    ],
                                    onsubmit: function( e ) {
                                        editor.insertContent(
                                            '<p><div class="iq-ct ' + e.data.ctYear + ' ' + e.data.ctType + '"><time>' + e.data.ctYear + '-' + e.data.ctMonth + '-' + e.data.ctDay + ' ' + e.data.ctTime + '' + e.data.ctUtc + '</time></div></p>&nbsp;');
                                    }
                                });
                            }
                        }
                    ]
                },
                {
                    text: 'Inline Column',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Column Options',
                            body: [
                                {
                                    type: 'textbox',
                                    name: 'subSecCustomPx',
                                    label: 'Custom Width (pixels) - Leave empty to have the column width flexible',
                                    value: ''
                                }
                                ,
                                {
                                    type: 'textbox',
                                    name: 'subSecPadding',
                                    label: 'Padding (pixels) - You will only be able to change this size by editing in Text mode',
                                    value: ''
                                }
                            ],
                            onsubmit: function( e ) {
                                if (e.data.subSecCustomPx == '') {
                                    var _style = 'flex: 1 1 0';
                                } else  {
                                    var _style = 'flex: 0 1 '+e.data.subSecCustomPx+'px';
                                }
                                if(e.data.subSecPadding !== '') {
                                    var _padding = '; padding:'+e.data.subSecPadding+'px'
                                } else { var _padding = ''}
                                var _break = '';
                                editor.insertContent(
                                    '<div class="sub-section" style="'+_style+''+_padding+'"><p>Column added, you can now delete this line.</p></div>&nbsp;');
                            }
                        });
                    }
                },
                {
                    text: 'Post Content',
                    onclick: function() {
                        editor.insertContent(
                            '<div class="post-content"><h2>Title</h2><p>Edit Me</p></div>&nbsp;');
                    }
                },
                {
                    text: 'Image Flips',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Image Flip',
                            body: [
                                {
                                    type: 'textbox',
                                    name: 'flipTitle',
                                    label: 'Title',
                                    value: 'You can edit me later'
                                },
                                {
                                    type: 'textbox',
                                    name: 'flipContent',
                                    label: 'Content',
                                    value: 'You can edit me later',
                                    multiline: true,
                                    minWidth: 300,
                                    minHeight: 100
                                },
                                {
                                    type: 'textbox',
                                    name: 'flipLink',
                                    label: 'Link',
                                    value: '#'
                                },
                                {
                                    type: 'listbox',
                                    name: 'flipDesign',
                                    label: 'Design',
                                    'values': [
                                        {text: 'Square/No Border', value: ''},
                                        {text: 'Square/Border Light', value: 'border-light'},
                                        {text: 'Square/Border Dark', value: 'border-dark'},
                                        {text: 'Circle/No Border', value: 'circle'},
                                        {text: 'Circle/Border Light', value: 'circle border-light'},
                                        {text: 'Circle/Border Dark', value: 'circle border-dark'}
                                    ]
                                },
                                {
                                    type: 'listbox',
                                    name: 'flipAnimation',
                                    label: 'Design',
                                    'values': [
                                        {text: 'Flip X', value: 'flip_h'},
                                        {text: 'Flip Y', value: 'flip_v'},
                                        {text: 'Fade', value: 'flip_textfade'},
                                        {text: 'Zoom In', value: 'flip_zoom'},
                                        {text: 'Slide Text X', value: 'flip_slideX'},
                                        {text: 'Slide Text Y', value: 'flip_slideY'}
                                    ]
                                }
                            ],
                            onsubmit: function( e ) {

                                var selected = tinyMCE.activeEditor.selection.getContent();

                                if( selected.match(/\<img.+\>/) ){
                                    var src = $(selected).attr('src');
                                    var alt = $(selected).attr('alt');
                                    var content =  '<div class="flip-container ' + e.data.flipDesign + ' ' + e.data.flipAnimation + '">' +
                                        '<p class="flip-paragraph"><a class="flip-link" href="' + e.data.flipLink + '"><img src="'+src+'" alt="'+alt+'" /></a></p>' +

                                        '<div class="flipper">' +
                                            '<div class="front" style="background-image:url(' + src + ');"></div>' +
                                            '<div class="back"><h2>' + e.data.flipTitle + '</h2><p>' + e.data.flipContent + '</p></div>' +
                                        '</div>' +
                                        '</div>' +
                                        '';
                                }else{
                                    var content =  'Make sure you have selected an image.';
                                }


                                editor.insertContent(
                                    ''+content+'&nbsp;');
                            }
                        });
                    }
                }
            ]
        });
    });
})();