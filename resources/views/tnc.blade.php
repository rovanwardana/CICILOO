@extends('layouts.app')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('title', 'Terms and Conditions')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-semibold text-gray-800">Terms and Conditions – Ciciloo</h1>
    <p class="text-gray-600">Last Updated: July 11, 2025</p>
</div>

<div class="bg-white p-6 rounded-xl shadow-md space-y-6">
    <div>
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Welcome to Ciciloo!</h2>
        <p class="text-gray-600">By accessing or using our website, you agree to the following terms and conditions:</p>
    </div>

    <div>
        <h2 class="text-lg font-semibold text-gray-700 mb-2">1. Acceptance of Terms</h2>
        <p class="text-gray-600">By registering and using Ciciloo, you agree to comply with and be bound by these Terms and Conditions.</p>
    </div>

    <div>
        <h2 class="text-lg font-semibold text-gray-700 mb-2">2. Use of the Service</h2>
        <p class="text-gray-600">Ciciloo is provided for the purpose of managing shared expenses, bill splitting, and personal tracking of debt and payments among users.</p>
    </div>

    <div>
        <h2 class="text-lg font-semibold text-gray-700 mb-2">3. User Accounts</h2>
        <p class="text-gray-600">You are responsible for maintaining the confidentiality of your account credentials and for all activities under your account.</p>
    </div>

    <div>
        <h2 class="text-lg font-semibold text-gray-700 mb-2">4. Data Accuracy</h2>
        <p class="text-gray-600">Users are responsible for entering accurate and truthful data related to transactions, amounts, and participants.</p>
    </div>

    <div>
        <h2 class="text-lg font-semibold text-gray-700 mb-2">5. Payment Handling</h2>
        <p class="text-gray-600">Ciciloo does not process actual payments; it only records and manages bill information. All settlements must be handled outside the platform.</p>
    </div>

    <div>
        <h2 class="text-lg font-semibold text-gray-700 mb-2">6. Privacy</h2>
        <p class="text-gray-600">Your personal data and transaction information are stored securely and will not be shared with third parties without your consent. Please see our Privacy Policy for more details.</p>
    </div>

    <div>
        <h2 class="text-lg font-semibold text-gray-700 mb-2">7. Prohibited Activities</h2>
        <p class="text-gray-600">You agree not to use Ciciloo for any illegal, fraudulent, or abusive purposes.</p>
    </div>

    <div>
        <h2 class="text-lg font-semibold text-gray-700 mb-2">8. Modifications</h2>
        <p class="text-gray-600">Ciciloo reserves the right to modify these terms at any time. Continued use of the service after changes implies acceptance of the revised terms.</p>
    </div>

    <div>
        <h2 class="text-lg font-semibold text-gray-700 mb-2">9. Termination</h2>
        <p class="text-gray-600">We reserve the right to suspend or terminate your access if you violate these terms or misuse the service.</p>
    </div>
</div>
@endsection