<script type="text/javascript">

$ ( document ) .ready ( function () {

    $('#dataTable').dataTable({

        "language": {

            "url": "http://cdn.datatables.net/plug-ins/f2c75b7247b/i18n/Arabic.json"

        },

        "pageLength": 50,

        stateSave: true,

        bDeferRender: true

    });

    $ ( '.itm' ) .keyup ( function () {
       var tot = 0 ;
       $ ( '.itm' ) . each ( function () {
           tot += Math .round ( $ ( this ) . val () * 100 ) / 100 ;
       } ) ;
       $ ( '#billTotal' ) .html ( Math .round ( tot * 100 ) / 100 );
    } );

    $ ( 'select' ) .change ( function () {

        var val = $ ( this ) .val () ;

        var fld = $ ( this ) .attr ( "name" ) ;

        var rnd = Math.floor ( ( Math.random () * 1000000 ) + 1 ) ;

        if ( val == 'new_acc' )

        {

            var account = prompt ( "أدخل اسم الحساب: ", "" ) ;

            $ ( this ) .wrap ( "<div id='new_acc_wrapper_" + rnd + "'></div>" ) ;

            $ ( '#new_acc_wrapper_' + rnd ) .html ( '' ) ;

            $.ajax({

                type: "POST",

                url: "<?=site_url ( 'acc/new_acc' )?>",

                data: { "acc_title": account, "fld": fld },

                dataType: "HTML",

                success: function ( out ) {

                    $ ( '#new_acc_wrapper_' + rnd ) .html ( out ) ;

                    $ ( '#new_gen_' + fld ) .unwrap () ;

                }

            });

        }

        else if ( val == 'new_cat' )

        {

            var cat_type = $ ( this ) .find ( ':selected' ) .data ( 'type' ) ;

            var cat_name = prompt ( "أدخل عنوان التصنيف: ", "" ) ;

            $ ( this ) .wrap ( "<div id='new_cat_wrapper_" + rnd + "'></div>" ) ;

            $ ( '#new_cat_wrapper_' + rnd ) .html ( '' ) ;

            $.ajax({

                type: "POST",

                url: "<?=site_url ( 'acc/new_cat' )?>",

                data: { "cat_name": cat_name, "cat_type": cat_type, "fld": fld },

                dataType: "HTML",

                success: function ( out ) {

                    $ ( '#new_cat_wrapper_' + rnd ) .html ( out ) ;

                    $ ( '#new_gen_' + fld ) .unwrap () ;

                }

            });

        }

        else if ( val == 'new_sub_cat' )

        {

            var parent_id = $ ( this ) .find ( ':selected' ) .data ( 'parent' ) ;

            var cat_type = $ ( this ) .find ( ':selected' ) .data ( 'type' ) ;

            var cat_name = prompt ( "أدخل عنوان التصنيف: ", "" ) ;

            $ ( this ) .wrap ( "<div id='new_cat_wrapper_" + rnd + "'></div>" ) ;

            $ ( '#new_cat_wrapper_' + rnd ) .html ( '' ) ;

            $.ajax({

                type: "POST",

                url: "<?=site_url ( 'acc/new_cat/" + parent_id + "' )?>",

                data: { "cat_name": cat_name, "cat_type": cat_type, "parent_id": parent_id, "fld": fld },

                dataType: "HTML",

                success: function ( out ) {

                    $ ( '#new_cat_wrapper_' + rnd ) .html ( out ) ;

                    $ ( '#new_gen_' + fld ) .unwrap () ;

                }

            });

        }

    } ) ;

} ) ;

</script>