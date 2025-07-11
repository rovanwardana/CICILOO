@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('title', 'Help')

@section('content')
    <!-- Main Content -->
    <div style="flex: 1; padding: 2rem; background-color: #f3f7fa; min-height: 80vh; ">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-semibold text-gray-800">Frequently Asked Questions</h1>
        </div>

        <div style="width: 100%; margin: 0 auto;">
            <div style="margin-bottom: 1rem; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                <button style="width: 100%; padding: 1rem; background-color: #1a2e44; color: #ffffff; border: none; text-align: left; border-radius: 8px 8px 0 0; cursor: pointer; font-size: clamp(0.875rem, 1.5vw, 1rem); display: flex; justify-content: space-between; align-items: center;">
                    <span>How do I create a new bill?</span>
                    <span style="transition: transform 0.3s;">▼</span>
                </button>
                <div style="display: none; padding: 1rem; background-color: #eef2f7; border-radius: 0 0 8px 8px; max-height: 0; overflow: hidden; transition: max-height 0.3s ease, padding 0.3s ease;">
                    To create a new bill, follow these steps:<br>
                    1. Click on the "New Bill" button in the sidebar menu<br>
                    2. Fill out the required information (amount, description, split options)<br>
                    3. Select friends to split with<br>
                    4. Click "Create Bill" to finalize
                </div>
            </div>

            <!-- Add more FAQ items as needed -->
            <div style="margin-bottom: 1rem; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                <button style="width: 100%; padding: 1rem; background-color: #1a2e44; color: #ffffff; border: none; text-align: left; border-radius: 8px 8px 0 0; cursor: pointer; font-size: clamp(0.875rem, 1.5vw, 1rem); display: flex; justify-content: space-between; align-items: center;">
                    <span>How do I add friends to my account?</span>
                    <span style="transition: transform 0.3s;">▼</span>
                </button>
                <div style="display: none; padding: 1rem; background-color: #eef2f7; border-radius: 0 0 8px 8px; max-height: 0; overflow: hidden; transition: max-height 0.3s ease, padding 0.3s ease;">
                    To add friends, follow these steps:<br>
                    1. Go to the "Friends" section in the sidebar<br>
                    2. Click "Add Friend"<br>
                    3. Enter your friend's email or phone number<br>
                    4. Send the invitation
                </div>
            </div>
             <div style="margin-bottom: 1rem; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                <button style="width: 100%; padding: 1rem; background-color: #1a2e44; color: #ffffff; border: none; text-align: left; border-radius: 8px 8px 0 0; cursor: pointer; font-size: clamp(0.875rem, 1.5vw, 1rem); display: flex; justify-content: space-between; align-items: center;">
                    <span>How do I split a bill unequally?</span>
                    <span style="transition: transform 0.3s;">▼</span>
                </button>
                <div style="display: none; padding: 1rem; background-color: #eef2f7; border-radius: 0 0 8px 8px; max-height: 0; overflow: hidden; transition: max-height 0.3s ease, padding 0.3s ease;">
                    When creating a new bill, after selecting friends to split with, you can choose "Split Unequally" instead of the default equal split. This will allow you to enter specific amounts or percentages for each person. You can also adjust by shares or enter exact amounts for each participant.
                </div>
            </div>
        </div>
    </div>

@push('scripts')
<script>
    document.querySelectorAll('button').forEach(button => {
        button.addEventListener('click', () => {
            const content = button.nextElementSibling;
            const icon = button.querySelector('span:last-child');
            
            if (content.style.maxHeight && content.style.maxHeight !== '0px') {
                // Closing
                content.style.maxHeight = '0px';
                content.style.padding = '0 1rem';
                icon.style.transform = 'rotate(0deg)';
                setTimeout(() => {
                    content.style.display = 'none';
                }, 300);
            } else {
                // Opening
                content.style.display = 'block';
                content.style.padding = '1rem';
                content.style.maxHeight = content.scrollHeight + 'px';
                icon.style.transform = 'rotate(180deg)';
            }
        });
    });
</script>
@endpush
@endsection