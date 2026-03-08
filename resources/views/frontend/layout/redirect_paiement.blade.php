<style>
    .loader-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-top: 20px;
    }

    .spinner {
        width: 50px;
        height: 50px;
        border: 5px solid #f3f3f3; 
        border-top: 5px solid #1526c0;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<form id="postForm" action="{{ $url }}" method="POST">
    @csrf

    <h3 style="text-align: center; margin-top:5%; font-weight: bold;">Redirection sur la plateforme de paiement CinetPay</h3>
    <div class="loader-container">
        <div class="spinner"></div>
        <p>Veuillez patienter...</p>
    </div>

    @foreach($data as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach
</form>

<script>
    document.getElementById('postForm').submit();
</script>