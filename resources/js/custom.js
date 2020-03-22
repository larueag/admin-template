function disableButton(button, icone) {
    var $this = button;
    var tag = $this[0].tagName.toLowerCase();

    if(icone === "" || icone === undefined)
        icone = "spinner";

    if(tag === 'a') {
        $this.prepend('<i class="fas fa-fw fa-' + icone + ' fa-spin"></i> ').addClass('disabled');
    } else if (tag === 'button') {
        $this.addClass('disabled');
        $this.prepend('<i class="fas fa-fw fa-' + icone + ' fa-spin"></i> ');
    }
}

function enableButton(button) {
    var $this = button;

    $this.removeClass('disabled');
    $this.html($this.text());
}

//FUNCOES PARA CONTROLE DOS CARDS
function enableCard(box) {
    if(box.find('.overlay').length) {
        box.find('.overlay').remove();
    }
}
function disableCard(box, icone = 'spinner') {
    if(!box.find('.overlay').length) {
        box.append('<div class="overlay"><i class="fas fa-2x fa-' + icone + ' fa-spin"></i></div>');
    }
}

function init(){
    $(document).ready(function () {
        $('.btn-delete-foto').on('click', function(){
            let self = $(this);
            Swal.fire({
                title: 'Atenção',
                text: "Deseja excluir a foto?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Excluir',
                cancelButtonText: 'Cancelar',
                showLoaderOnConfirm: true,
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.value) {
                    let url = self.attr('data-route');
                    disableButton(self);
                    axios.delete(url).then(function(response){
                        location.reload(true);
                    }).catch(function(error){
                        console.log(error);
                    });
                }
            });
        });

        $('.file-selector input').on('change', function() {
            var filename = $('.file-selector input').val().split('\\').pop();
            $('.file-selector .filename').text(filename);
        });

        $('body').on('click', '.btn-show', function(e){
            e.preventDefault();
            let self = $(this);
            let url = self.attr('href');
            let container = $('#'+self.attr('data-container'));
            let card = self.closest('.card');

            disableCard(card);
            axios.get(url).then(function(response){
                container.html(response.data.html);
                container[0].scrollIntoView();
            }).catch(function(error){
                console.log(error);
            }).then(function(){
                enableCard(card);
            });
        });
        $('body').on('click', '.btn-delete', function(){
            let self = $(this);

            if($('.check_item:checked').length) {
                Swal.fire({
                    title: 'Atenção',
                    text: "Deseja excluir os itens selecionados?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Excluir',
                    cancelButtonText: 'Cancelar',
                    showLoaderOnConfirm: true,
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.value) {
                        let url = self.attr('data-link');
                        let selected = [];
                        let data = {
                            params: {
                                selected
                            }
                        };
                        $.each($('.check_item:checked'), function(){
                            selected.push($(this).val());
                        });

                        axios.delete(url, data).then(function(response){
                            location.reload(true);
                        }).catch(function(error){
                            console.log(error);
                        });
                    }
                });
            } else {
                Swal.fire(
                    'Atenção',
                    'Selecione um item para excluir',
                    'warning'
                )
            }

        });

        $('body').on('click', '.check_all', function(){
            let checked = $(this).prop('checked');
            $('.check_item').prop('checked', checked);
            $('.btn-delete').prop('disabled', !$('.check_item:checked').length);
        });

        $('body').on('click', '.check_item', function(){
            $('.btn-delete').prop('disabled', !$('.check_item:checked').length);
        });

        $('body').on('click', '.btn-toggle', function(){
            disableButton($(this));
        });

        $('body').on('click', '.ajax-pagination a', function(e) {
            e.preventDefault();
            let self = $(this);
            let card = self.closest('.card');
            let container = $('#'+self.closest('.ajax-pagination').attr('data-container'));
            let request = self.closest('.ajax-pagination').attr('data-request');
            let url = self.attr('href');

            let data = {
                params: JSON.parse(request)
            };

            disableCard(card);
            axios.get(url, data).then(function(response){
                if(response.data.html)
                    container.html(response.data.html);
                console.log(container);
            }).catch(function(error){
                console.log(error);
            }).then(function(){
                enableCard(card);
            });

        });

        $(".select2").select2({
            placeholder: "Marque um ou mais itens",
            closeOnSelect: false,
            language: 'pt-BR'
        });

        $('[data-fancybox]').fancybox({
            infobar : false,
            caption : function( instance, item ) {
                var caption = $(this).data('caption') || '';
                var credito = $(this).data('credito') || '';
                return ( credito.length ? credito + '<br />' : '' ) + ( caption.length ? caption : '' );
            },
            animationEffect  : 'zoom-in-out',
            transitionEffect : "circular",
            lang : 'pt-br',
            i18n : {
                'pt-br' : {
                    CLOSE       : 'Fechar',
                    NEXT        : 'Próximo',
                    PREV        : 'Anterior',
                    ERROR       : 'Erro ao carregar conteúdo. Tente novamente mais tarde.',
                    PLAY_START  : 'Iniciar apresentação de slides',
                    PLAY_STOP   : 'Pausar apresentação de slides',
                    FULL_SCREEN : 'Tela cheia',
                    THUMBS      : 'Miniaturas',
                    ZOOM        : 'Zoom'
                }
            }
        });

        // MÁSCARAS
        var PhoneMaskBehavior = function (val) {
            let val2 = val.replace(/\D/g, '');

            if (val2.length === 11 && val2.substr(0, 4) == '0800')
                return '0000-000-0000';
            else if (val2.length === 11)
                return '(00) 0 0000-0000';
            else
                return '(00) 0000-00009';
        };

        var phoneMaskOptions = {
            onKeyPress: function (val, e, field, options) {
                field.mask(PhoneMaskBehavior.apply({}, arguments), options);
            }
        };

        $('.fone-mask').mask(PhoneMaskBehavior, phoneMaskOptions);
        $('.date-mask').mask("00/00/0000");
        $('.time-mask').mask("00:00");
        $('.cpf-mask').mask("999.999.999-99");
        $('.cnpj-mask').mask("99.999.999/9999-99");
        $('.integer-mask').mask("#");
        $('.number-mask').mask("#.###.###.###", {reverse: true});
        $('.cep-mask').mask("99999-999");
        $('.money-mask').mask('000.000.000.000.000,00', {reverse: true});
        $('.money-mask-unitario').mask('000.000.000.000.000,000', {reverse: true});
    });
}
export default init();
