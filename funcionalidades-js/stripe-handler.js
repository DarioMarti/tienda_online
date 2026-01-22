const stripe = Stripe('pk_test_51SjaCeQ2gnFM99eyyW9LtaYHxFUMg3PPqUaj3xetyr31veB0Bvs6oVNiFarjrJEcDJWKrSWNZRnIvClPYGga8ncp00uPfDIvD3');

document.getElementById('realizar-pago-btn').addEventListener('click', async (event) => {
    event.preventDefault();


    try {

        const form = document.getElementById('checkout-form');
        const formData = new FormData(form);

        // Inicia la sesión de Stripe enviando los datos del formulario
        const respuestaStripe = await fetch(RUTA_WEB + '/modelos/confirmar-pago.php', {
            method: 'POST',
            body: formData
        });
        const session = await respuestaStripe.json();

        if (session.error) throw new Error(session.error);

        const resultado = await stripe.redirectToCheckout({ sessionId: session.id });

        if (resultado.error) throw new Error(resultado.error.message);

    } catch (error) {
        console.error('Error:', error);
        alert('Hubo un problema: ' + error.message);

    }
});