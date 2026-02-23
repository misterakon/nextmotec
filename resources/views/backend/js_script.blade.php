<script type="text/javascript">

	//add_form() used to show the modal form
	function add_form() {	

		// Nettoyage dynamique
    $('#fonctionnalite-wrapper .fonctionnalite-item:not(.fonctionnalite-master)').remove();
    $('#document-wrapper .document-item:not(.document-master)').remove();
    $('#prix-wrapper .prix-item:not(.prix-master)').remove();// prix NIAMIEN

		$('.modal_form').trigger('reset');
		$('#modal_form').modal('show');
	}

  function edit_type(id) 
	{		
		$('.modal_form').trigger('reset'); // reset du formulaire
		$('.bouton').html('Modifier');

		$.ajax({
			url: "{{ route('parametre.get_type', ':id') }}".replace(':id', id),
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				// Champs simples
				$('[name="id_"]').val(data.id);
				$('[name="libelle"]').val(data.name);

				// Ouverture du modal
				$('#modal_form').modal('show');
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert('Erreur lors du chargement des données.');
			}
		});
	}

  function edit_categorie(id) 
	{		
		$('.modal_form').trigger('reset'); // reset du formulaire
		$('.bouton').html('Modifier');

		$.ajax({
			url: "{{ route('parametre.get_categorie', ':id') }}".replace(':id', id),
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				// Champs simples
				$('[name="id_"]').val(data.id);
				$('[name="libelle"]').val(data.name);

				// Ouverture du modal
				$('#modal_form').modal('show');
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert('Erreur lors du chargement des données.');
			}
		});
	}

   function edit_temoignage(id) 
	{		
		$('.modal_form').trigger('reset'); // reset du formulaire
		$('.bouton').html('Modifier');

		$.ajax({
			url: "{{ route('prod.get_temoignage', ':id') }}".replace(':id', id),
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				// Champs simples
				$('[name="id_"]').val(data.id);
				$('[name="titre"]').val(data.titre);
        $('[name="notation"]').val(data.notation);
        $('[name="commentaire"]').val(data.contenue);
        $('[name="statut"]').val(data.active == true ? 1 : 0);

				// Ouverture du modal
				$('#modal_form').modal('show');
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert('Erreur lors du chargement des données.');
			}
		});
	}

  function edit_produit(id) {

    $('.modal_form').trigger('reset'); // reset du formulaire
    $('.bouton').text('Modifier');

    $('#formFile').prop('required', false)

    // Nettoyage dynamique
    $('#fonctionnalite-wrapper .fonctionnalite-item:not(.fonctionnalite-master)').remove();
    $('#document-wrapper .document-item:not(.document-master)').remove();
    $('#prix-wrapper .prix-item:not(.prix-master)').remove();// prix NIAMIEN

    $.ajax({
      url: "{{ route('prod.get_produit', ':id') }}".replace(':id', id),
      type: "GET",
      dataType: "json",
      success: function (data) {

        /* =========================
          Champs simples
        ========================= */
        $('[name="id_"]').val(data.id);
        $('[name="libelle"]').val(data.name);
        //$('[name="prix"]').val(data.price);
        $('[name="short_desc"]').val(data.short_desc);
        $('[name="presentation"]').val(data.long_desc);
        $('[name="statut"]').val(data.active == true ? 1 : 0);

        $('[name="type_client"]').val(data.customer_type_id);
        $('[name="categorie"]').val(data.category_id);

        if (data.image) {
          const filePath = `storage/app/public/${data.image}`;
          $('.fic1').attr('href', filePath).attr('target', '_blank').show(); 
        } else {
          $('.fic1').hide(); 
        }

        /* ON CHARGE LES FONCTIONNALITÉS */
        if (data.features && data.features.length) {

          // Première ligne (master)
          let master = $('#fonctionnalite-wrapper .fonctionnalite-master');
          master.find('input').val(data.features[0].title).css('border-color', '#025f07');

          // Lignes suivantes
          for (let i = 1; i < data.features.length; i++) {
            add_ligne_fonctionnalite();
            $('#fonctionnalite-wrapper .fonctionnalite-item:last').find('input').val(data.features[i].title).css('border-color', '#025f07');
          }
        }

        //  /* ON CHARGE DES PRIX */
        // if (data.features && data.features.length) {

        //   // Première ligne (master)
        //   let master = $('#prix-wrapper .prix-master');
        //   master.find('input').val(data.features[0].title).css('border-color', '#025f07');

        //   // Lignes suivantes
        //   for (let i = 1; i < data.features.length; i++) {
        //     add_ligne_prix();
        //     $('#prix-wrapper .prix-item:last').find('input').val(data.features[i].title).css('border-color', '#025f07');
        //   }
        // }

        /* ON CHARGE LES DOCUMENTS ENREGISTRES */
        if (data.documentations && data.documentations.length) {

          const firstDoc = data.documentations[0];
          fill_document_line($('.document-master'), firstDoc);

          $('.document-master').find('.doc-id').val(firstDoc.id);
          $('.document-master').find('input, select').css('border-color', '#025f07');

          for (let i = 1; i < data.documentations.length; i++) {
            add_ligne_document();

            let row = $('#document-wrapper .document-item:last');

            fill_document_line($('#document-wrapper .document-item:last'), data.documentations[i]);
            row.find('.doc-id').val(data.documentations[i].id);

            //on change ici la couleur des champs pour les données chargées depuis la base
            $('#document-wrapper .document-item:last').find('input, select').css('border-color', '#025f07');
          }
        }
      

        /* ON CHARGE LES prix ENREGISTRES */
        if (data.prix && data.prix.length) {

          const firstPrix = data.prix[0];
          fill_prix_line($('.prix-master'), firstPrix);

          $('.prix-master').find('.prix-id').val(firstPrix.id);
          $('.prix-master').find('input, select').css('border-color', '#025f07');

          for (let i = 1; i < data.prix.length; i++) {
            add_ligne_prix();

            let row = $('#prix-wrapper .prix-item:last');

            fill_prix_line($('#prix-wrapper .prix-item:last'), data.prix[i]);
            row.find('.prix-id').val(data.prix[i].id);

            //on change ici la couleur des champs pour les données chargées depuis la base
            $('#prix-wrapper .prix-item:last').find('input, select').css('border-color', '#025f07');
          }
        }


        

        // Ouvrir le modal
        $('#modal_form').modal('show');
      },
      error: function () {
        Swal.fire({
          icon: 'error',
          title: 'Erreur',
          text: 'Impossible de charger les données du produit'
        });
      }
    });
  }

  function fill_document_line(row, doc) {

    row.find('.type-doc').val(doc.type);

    row.find('input[name="titre_doc[]"]').val(doc.title);

    if (doc.type === 'pdf') {
      row.find('.fichier').show().prop('required', false);
      row.find('.lien-video').hide().val('');
    }

    if (doc.type === 'video') {
      row.find('.fichier').hide().val('');
      row.find('.lien-video').show().val(doc.url);
    }
  }

   function fill_prix_line(row, price) {

    row.find('.type-abon').val(price.type);

    row.find('input[name="prix[]"]').val(price.title);
    row.find('input[name="titre_abon[]"]').val(price.title);
	
	  row.find('.type_statut').val(price.type);

  }

  function deletes(route, id) {
    Swal.fire({
      // title: 'Are you sure?',
      text: "Êtes-vous sûr de vouloir supprimer cette ligne ?",
      icon: 'warning',
      showCancelButton: true,
      cancelButtonText: 'Annuler',
      confirmButtonText: 'Oui, supprimer',
      customClass: {
        confirmButton: 'btn btn-primary',
        cancelButton: 'btn btn-label-secondary'
      },
      buttonsStyling: false
    }).then(function (result) {
      if (result.value) {

        $.ajax({
					url: route.replace(':id', id),
					type: "DELETE",
					data: { _token: "{{ csrf_token() }}" },
					success: function (response) {
						if (response.status) {

              Swal.fire({
                icon: 'success',
                text: "Suppression effectuée avec succes!",
                customClass: {
                  confirmButton: 'btn btn-success waves-effect waves-light'
                }
              });

							$("#row-" + id).fadeOut(500, function() {
								$(this).remove();
							});

						} else {
							Swal.fire({
                icon: 'error',
                text: "Erreur survenur lors de la suppression",
                customClass: {
                  confirmButton: 'btn btn-danger waves-effect waves-light'
                }
              });
						}
					},
					error: function () {
						Swal.fire('Erreur', "Une erreur s'est produite lors de la suppression.", 'error');
					}
				});

      }
    });

	}

  function change_type_doc(el)
  {
    let parent = $(el).closest('.document-item');
    let type   = $(el).val();

    // Réinitialisation des champs
    parent.find('.fichier').val('');
    parent.find('.lien-video').val('');

    if (type === 'video') {
      parent.find('.fichier').hide().prop('required', false);
      parent.find('.lien-video').show().prop('required', true);
    }
    else if (type === 'pdf') {
      parent.find('.fichier').show().prop('required', true);
      parent.find('.lien-video').hide().prop('required', false);
    }
    else {
      parent.find('.fichier').hide().prop('required', false);
      parent.find('.lien-video').hide().prop('required', false);
    }
  }

  function add_ligne_fonctionnalite() {
    let item = $('.fonctionnalite-master').clone();

    item.removeClass('fonctionnalite-master from-db').addClass('new-line');

    item.find('input').val('').css('border-color', '');
    item.find('.col-md-2').remove(); // enlever boutons

    $('#fonctionnalite-wrapper').append(item);
  }

  function delete_ligne_fonctionnalite() {
    // Supprimer uniquement la dernière ligne ajoutée
    let lastNew = $('#fonctionnalite-wrapper .new-line').last();

    if (lastNew.length) {
      lastNew.remove();
    }
  }
//function prix add et delete NIAMIEN
  //  function add_ligne_prix() {
  //   let item = $('.prix-master').clone();

  //   item.removeClass('prix-master from-db').addClass('new-line');

  //   item.find('input').val('').css('border-color', '');
  //   item.find('.col-md-2').remove(); // enlever boutons

  //   $('#prix-wrapper').append(item);
  // }

  // function delete_ligne_prix() {
  //   // Supprimer uniquement la dernière ligne ajoutée
  //   let lastNew = $('#prix-wrapper .new-line').last();

  //   if (lastNew.length) {
  //     lastNew.remove();
  //   }
  // }
// END FUNCTION PRIX

  function add_ligne_document() {
    let item = $('.document-master').clone();

    //On Nettoie
    item.removeClass('document-master');

    item.find('input').val('').css('border-color', '');
    item.find('input, select').val('').css('border-color', '');

    //on supprime la colonne boutons dans les lignes clonées
    item.find('.col-md-1').remove();

    $('#document-wrapper').append(item);
  }


   function add_ligne_prix() {
    let item = $('.prix-master').clone();

    //On Nettoie
    item.removeClass('prix-master');

    item.find('select').val('').css('border-color', '');
    item.find('input, select').val('').css('border-color', '');

    //on supprime la colonne boutons dans les lignes clonées
    item.find('.col-md-1').remove();

    $('#prix-wrapper').append(item);
  }

  function delete_ligne_document() {
    let items = $('.document-item');

    //Ne jamais supprimer la ligne principale
    if (items.length > 1) {
      items.last().remove();
    }
  }

  function delete_ligne_prix() {
    let items = $('.prix-item');

    //Ne jamais supprimer la ligne principale
    if (items.length > 1) {
      items.last().remove();
    }
  }


		
</script>



