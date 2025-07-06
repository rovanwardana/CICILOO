import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const toggleBtn = document.querySelector('#sidebar button');
    const sidebar = document.getElementById('sidebar');
    const labels = sidebar.querySelectorAll('.label');
    const mainContent = document.getElementById('mainContent');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('w-[220px]');
        sidebar.classList.toggle('w-[90px]');

        labels.forEach(label => label.classList.toggle('hidden'));

        mainContent.classList.toggle('ml-[240px]');
        mainContent.classList.toggle('ml-[80px]');
    });

    // New Bill functionality
    initializeNewBillForm();
});

// Tab logic: Split Bill ↔ Group Bill
const splitTab = document.querySelector('#tab-split');
const groupTab = document.querySelector('#tab-group');
const splitSection = document.querySelector('#split-bill-section');
const groupSection = document.querySelector('#group-bill-section');

if (splitTab && groupTab && splitSection && groupSection) {
    splitTab.addEventListener('click', () => {
        splitTab.classList.add('text-blue-600', 'border-blue-600');
        splitTab.classList.remove('text-gray-500');
        groupTab.classList.remove('text-blue-600', 'border-blue-600');
        groupTab.classList.add('text-gray-500');

        splitSection.classList.remove('hidden');
        groupSection.classList.add('hidden');
    });

    groupTab.addEventListener('click', () => {
        groupTab.classList.add('text-blue-600', 'border-blue-600');
        groupTab.classList.remove('text-gray-500');
        splitTab.classList.remove('text-blue-600', 'border-blue-600');
        splitTab.classList.add('text-gray-500');

        groupSection.classList.remove('hidden');
        splitSection.classList.add('hidden');
    });
}

// New Bill Form functionality
function initializeNewBillForm() {
    // Check if we're on the new bill page
    const newBillForm = document.querySelector('#new-bill-form');
    if (!newBillForm) return;

    let participantsList = [];
    let itemCount = 1;

    // Tab switching for Split Bill / Group Bill
    const splitBillTab = document.getElementById('split-bill-tab');
    const groupBillTab = document.getElementById('group-bill-tab');
    const splitBillContent = document.getElementById('split-bill-content');
    const groupBillContent = document.getElementById('group-bill-content');

    if (splitBillTab && groupBillTab && splitBillContent && groupBillContent) {
        splitBillTab.addEventListener('click', function() {
            splitBillTab.classList.add('text-blue-600', 'border-blue-600');
            splitBillTab.classList.remove('text-gray-500');
            groupBillTab.classList.add('text-gray-500');
            groupBillTab.classList.remove('text-blue-600', 'border-blue-600');
            splitBillContent.classList.remove('hidden');
            groupBillContent.classList.add('hidden');
        });

        groupBillTab.addEventListener('click', function() {
            groupBillTab.classList.add('text-blue-600', 'border-blue-600');
            groupBillTab.classList.remove('text-gray-500');
            splitBillTab.classList.add('text-gray-500');
            splitBillTab.classList.remove('text-blue-600', 'border-blue-600');
            groupBillContent.classList.remove('hidden');
            splitBillContent.classList.add('hidden');
        });
    }

    // Bill name to tab name
    const billNameInput = document.getElementById('bill-name');
    const billTab = document.getElementById('bill-1');
    if (billNameInput && billTab) {
        billNameInput.addEventListener('input', function() {
            const billName = this.value || 'Bill 1';
            billTab.textContent = billName;
        });
    }

    // Add participant functionality
    const addParticipantBtn = document.getElementById('add-participant');
    const participantInput = document.getElementById('participant-input');
    
    if (addParticipantBtn && participantInput) {
        addParticipantBtn.addEventListener('click', function() {
            const participant = participantInput.value.trim();
            
            if (participant && !participantsList.includes(participant)) {
                participantsList.push(participant);
                addParticipantTag(participant);
                updateAssignedToOptions();
                updateSplitSummary();
                participantInput.value = '';
            }
        });

        // Enter key for participant input
        participantInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                addParticipantBtn.click();
            }
        });
    }

    function addParticipantTag(participant) {
        const participantsListEl = document.getElementById('participants-list');
        if (!participantsListEl) return;

        const tag = document.createElement('span');
        tag.className = 'bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm flex items-center space-x-2';
        tag.innerHTML = `
            <span>${participant}</span>
            <button type="button" class="text-blue-500 hover:text-blue-700 ml-2" onclick="removeParticipant('${participant}')">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        `;
        participantsListEl.appendChild(tag);
    }

    // Global function for removing participants
    window.removeParticipant = function(participant) {
        participantsList = participantsList.filter(p => p !== participant);
        updateParticipantTags();
        updateAssignedToOptions();
        updateSplitSummary();
    };

    function updateParticipantTags() {
        const participantsListEl = document.getElementById('participants-list');
        if (!participantsListEl) return;

        participantsListEl.innerHTML = '';
        participantsList.forEach(participant => {
            addParticipantTag(participant);
        });
    }

    function updateAssignedToOptions() {
        const assignedToSelects = document.querySelectorAll('.assigned-to-select');
        assignedToSelects.forEach(select => {
            const currentValue = select.value;
            select.innerHTML = '<option value="">Select Person</option>';
            participantsList.forEach(participant => {
                const option = document.createElement('option');
                option.value = participant;
                option.textContent = participant;
                if (currentValue === participant) {
                    option.selected = true;
                }
                select.appendChild(option);
            });
        });
    }

    // Split method change
    const splitMethodSelect = document.getElementById('split-method');
    if (splitMethodSelect) {
        splitMethodSelect.addEventListener('change', function() {
            const isCustom = this.value === 'custom';
            const assignedToHeader = document.getElementById('assigned-to-header');
            const assignedToCells = document.querySelectorAll('.assigned-to-cell');
            
            if (assignedToHeader) {
                assignedToHeader.style.display = 'table-cell';
            }
            
            assignedToCells.forEach(cell => {
                const selectEl = cell.querySelector('.assigned-to-select');
                const textEl = cell.querySelector('.equal-split-text');
                
                if (selectEl && textEl) {
                    if (isCustom) {
                        selectEl.style.display = 'block';
                        textEl.style.display = 'none';
                    } else {
                        selectEl.style.display = 'none';
                        textEl.style.display = 'block';
                    }
                }
            });
            updateSplitSummary();
        });
    }

    // Add item functionality
    const addItemBtn = document.getElementById('add-item');
    if (addItemBtn) {
        addItemBtn.addEventListener('click', function() {
            const tableBody = document.getElementById('items-table-body');
            if (tableBody) {
                const newRow = createItemRow(itemCount);
                tableBody.appendChild(newRow);
                itemCount++;
                updateAssignedToOptions();
            }
        });
    }

    function createItemRow(index) {
        const row = document.createElement('tr');
        row.className = 'item-row';
        
        const splitMethodSelect = document.getElementById('split-method');
        const splitMethod = splitMethodSelect ? splitMethodSelect.value : 'equal';
        const assignedToDisplay = splitMethod === 'custom' ? 'block' : 'none';
        const equalSplitDisplay = splitMethod === 'custom' ? 'none' : 'block';
        
        row.innerHTML = `
            <td class="px-4 py-3 border-b">
                <input type="text" name="items[${index}][name]" placeholder="Enter item name" 
                       class="w-full border-0 focus:ring-0 p-0" />
            </td>
            <td class="px-4 py-3 border-b">
                <input type="number" name="items[${index}][quantity]" value="1" min="1" 
                       class="w-full border-0 focus:ring-0 p-0 quantity-input" />
            </td>
            <td class="px-4 py-3 border-b">
                <div class="flex items-center">
                    <span class="text-gray-500 mr-1">Rp.</span>
                    <input type="number" name="items[${index}][unit_price]" value="0" min="0" step="0.01" 
                           class="w-full border-0 focus:ring-0 p-0 unit-price-input" />
                </div>
            </td>
            <td class="px-4 py-3 border-b">
                <span class="text-gray-500">Rp.</span>
                <span class="item-total">0</span>
            </td>
            <td class="px-4 py-3 border-b assigned-to-cell">
                <select name="items[${index}][assigned_to]" class="w-full border-0 focus:ring-0 p-0 assigned-to-select" style="display: ${assignedToDisplay};">
                    <option value="">Select Person</option>
                </select>
                <span class="equal-split-text" style="display: ${equalSplitDisplay};">Auto Split</span>
            </td>
            <td class="px-4 py-3 border-b">
                <button type="button" class="text-red-600 hover:text-red-700 remove-item">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </td>
        `;
        
        // Add event listeners for calculation
        const quantityInput = row.querySelector('.quantity-input');
        const unitPriceInput = row.querySelector('.unit-price-input');
        const removeBtn = row.querySelector('.remove-item');
        
        if (quantityInput) quantityInput.addEventListener('input', calculateTotals);
        if (unitPriceInput) unitPriceInput.addEventListener('input', calculateTotals);
        if (removeBtn) {
            removeBtn.addEventListener('click', function() {
                row.remove();
                calculateTotals();
            });
        }
        
        return row;
    }

    // Calculate totals
    function calculateTotals() {
        let subtotal = 0;
        
        document.querySelectorAll('.item-row').forEach(row => {
            const quantityInput = row.querySelector('.quantity-input');
            const unitPriceInput = row.querySelector('.unit-price-input');
            const itemTotalSpan = row.querySelector('.item-total');
            
            const quantity = parseFloat(quantityInput ? quantityInput.value : 0) || 0;
            const unitPrice = parseFloat(unitPriceInput ? unitPriceInput.value : 0) || 0;
            const total = quantity * unitPrice;
            
            if (itemTotalSpan) {
                itemTotalSpan.textContent = total.toLocaleString('id-ID');
            }
            subtotal += total;
        });
        
        const discountInput = document.getElementById('discount');
        const taxPercentageInput = document.getElementById('tax-percentage');
        
        const discount = parseFloat(discountInput ? discountInput.value : 0) || 0;
        const taxPercentage = parseFloat(taxPercentageInput ? taxPercentageInput.value : 0) || 0;
        const taxAmount = ((subtotal - discount) * taxPercentage) / 100;
        const totalAmount = subtotal - discount + taxAmount;
        
        // Update UI elements
        const subtotalSpan = document.getElementById('subtotal');
        const discountAmountSpan = document.getElementById('discount-amount');
        const taxAmountSpan = document.getElementById('tax-amount');
        const totalAmountSpan = document.getElementById('total-amount');
        
        if (subtotalSpan) subtotalSpan.textContent = subtotal.toLocaleString('id-ID');
        if (discountAmountSpan) discountAmountSpan.textContent = discount.toLocaleString('id-ID');
        if (taxAmountSpan) taxAmountSpan.textContent = taxAmount.toLocaleString('id-ID');
        if (totalAmountSpan) totalAmountSpan.textContent = totalAmount.toLocaleString('id-ID');
        
        updateSplitSummary();
    }

    function updateSplitSummary() {
        const splitSummary = document.getElementById('split-summary');
        if (!splitSummary) return;

        const totalAmountSpan = document.getElementById('total-amount');
        const splitMethodSelect = document.getElementById('split-method');
        
        const totalAmount = parseFloat(totalAmountSpan ? totalAmountSpan.textContent.replace(/[.,]/g, '') : 0) || 0;
        const splitMethod = splitMethodSelect ? splitMethodSelect.value : 'equal';
        
        if (participantsList.length === 0) {
            splitSummary.innerHTML = '<p class="text-sm text-gray-600">Add participants to see split breakdown</p>';
            return;
        }
        
        let summaryHTML = '';
        
        if (splitMethod === 'equal') {
            const amountPerPerson = totalAmount / participantsList.length;
            participantsList.forEach(participant => {
                summaryHTML += `<div class="flex justify-between mb-2">
                    <span class="text-sm">${participant}:</span>
                    <span class="text-sm font-medium">Rp. ${amountPerPerson.toLocaleString('id-ID')}</span>
                </div>`;
            });
        } else {
            // Custom split logic - for now showing 0, can be enhanced later
            participantsList.forEach(participant => {
                summaryHTML += `<div class="flex justify-between mb-2">
                    <span class="text-sm">${participant}:</span>
                    <span class="text-sm font-medium">Rp. 0</span>
                </div>`;
            });
        }
        
        splitSummary.innerHTML = summaryHTML;
    }

    // Event listeners for tax and discount
    const taxPercentageInput = document.getElementById('tax-percentage');
    const discountInput = document.getElementById('discount');
    
    if (taxPercentageInput) taxPercentageInput.addEventListener('input', calculateTotals);
    if (discountInput) discountInput.addEventListener('input', calculateTotals);
    
    // Initial calculation
    calculateTotals();
}