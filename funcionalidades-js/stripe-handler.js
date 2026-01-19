const stripe = Stripe('pk_test_51SjaCeQ2gnFM99eyyW9LtaYHxFUMg3PPqUaj3xetyr31veB0Bvs6oVNiFarjrJEcDJWKrSWNZRnIvClPYGga8ncp00uPfDIvD3');

document.getElementById('realizar-pago-btn').addEventListener('click', async (event) => {
    event.preventDefault();

    const form = document.getElementById('checkout-form');

    try {
        //Se crea el pedido con los datos del formulario
        const formData = new FormData(form);

        const responsePedido = await fetch('../../modelos/pedido/crear-pedido.php', {
            method: 'POST',
            body: formData
        });

        if (!responsePedido.ok) throw new Error('Error de conexión con el servidor');

        //Se inicia la sesión de Stripe
        const respuestaStripe = await fetch('../../modelos/confirmar-pago.php', { method: 'POST' });
        const session = await respuestaStripe.json();

        if (session.error) throw new Error(session.error);

        const resultado = await stripe.redirectToCheckout({ sessionId: session.id });

        if (resultado.error) throw new Error(resultado.error.message);

    } catch (error) {
        console.error('Error:', error);
        alert('Hubo un problema: ' + error.message);

    }
});