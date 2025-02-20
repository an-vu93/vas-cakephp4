<section class="mx-auto bg-white shadow-md rounded-lg overflow-hidden mb-10">
    <div class="p-6">
    <h2 class="text-2xl font-semibold mb-6">全国企業情報の検索（約550万社）</h2>
        <?= $this->Form->create(null, [
            'type' => 'get',
        ]) ?>

    </div>

    <div class="flex justify-center">
        <div class="w-2/3">
            <?= $this->Form->control('corporate_number', [
                'type' => 'text',
                'label' => [
                    'text' => '法人番号',
                    'class' => 'font-medium bg-primary-500 text-white w-1/4',
                ],
                'class' => 'shadow w-3/4 bg-gray-50 text-gray-900 border border-gray-300 focus:ring-primary-500 focus:border-primary-500 p-2.5',
                'value' => $requestParams['corporate_number'] ?? '',
            ]) ?>

            <div>
                法人番号の入手については、経済産業省の
                <a href="https://info.gbiz.go.jp/" class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline" target="_blank">info.gbiz.go.jp</a>
                （社名で検索）または企業ホームページでご確認ください。
            </div>
        </div>
    </div>
    <div class="mt-8 flex justify-center space-x-4">
        
    </div>
    <div class="mt-8 flex justify-center space-x-4">
        <button type="submit" class="inline-flex items-center py-2.5 px-5 ms-2 text-sm font-medium text-white bg-primary-700 rounded-lg border border-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300">
            <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>検索
        </button>
    </div>
    <?= $this->Form->end() ?>
</section>

<section class="mx-auto bg-white shadow-md rounded-lg overflow-hidden">
    <?php if (!empty($corporation)): ?>
    <div class= "p-6">
        <h2 class="text-2xl font-semibold mb-6">検索結果</h2>
        <div>
            <table>
                <tr>
                    <th>社名</th>
                    <td>
                        <?php if ($dsCustomer): ?>
                            <?= $this->Html->link(
                                $corporation->name,
                                ['action' => 'index', '?' => [
                                    'query' => $dsCustomer->customer_id,
                                    'analysis_id' => 2
                                    ]
                                ],
                                ['class' => 'inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline']
                            ) ?>
                            <span class="bg-primary-500 text-white">DS顧客</span>
                        <?php else:
                            echo $corporation->name;
                        endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>都道府県</th>
                    <td><?= $corporation->prefecture_name ?></td>
                </tr>
                <tr>
                    <th>市町村区</th>
                    <td><?= $corporation->city_name ?></td>
                </tr>
                <tr>
                    <th>番地</th>
                    <td><?= $corporation->street_number ?></td>
                </tr>
                <tr>
                    <th>ホームページ</th>
                    <td><a href="<?= $corporation->homepage ?>" class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline"><?= $corporation->homepage ?></a></td>
                </tr>
                <tr>
                    <th>従業員数</th>
                    <td><?= $corporation->number_of_employees ?></td>
                </tr>
                <tr>
                    <th>資本金</th>
                    <td><?= $corporation->capital ?></td>
                </tr>
                <tr>
                    <th>売上高</th>
                    <td><?= $corporation->revenue ?></td>
                </tr>
                <tr>
                    <th>求人確認</th>
                    <td> 
                        <a 
                            class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline"
                            data-corporate-number="<?= $corporation->corporate_number ?>"
                            onclick="openModal(this, checkHellowork)"
                        >
                            詳細
                        </a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <?php endif; ?>

    <div id="modalContainer" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-8 max-w-lg max-h-96 w-full mx-4 overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 id="modalTitle" class="text-xl font-bold">Details</h3>
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div id="modalContent" class="mt-4">
        </div>
    </div>
</div>
</section>


<script>
async function openModal(button, setFunction) {
    
    const title = button.getAttribute('data-title');
    document.getElementById('modalTitle').textContent = title;
    
    // Wait for the setFunction to complete
    await setFunction(button);

    // Show modal
    document.getElementById('modalContainer').classList.remove('hidden');
    
    // Prevent body scrolling
    document.body.style.overflow = 'hidden';
}

function closeModal() {

    document.getElementById('modalContainer').classList.add('hidden');
    document.getElementById('modalContent').innerHTML = "";
    
    // Restore body scrolling
    document.body.style.overflow = 'auto';
}

function displayData(button) {
    const modalContent = document.getElementById('modalContent');
    
    modalContent.innerHTML = '';
    
    const dataAttributes = button.dataset;

    for (const [key, value] of Object.entries(dataAttributes)) {
        if (key === "title")
            continue
        if (key === "description") {
            modalContent.innerHTML += `<p class="mb-4">${value}</p>`;
            continue
        }
        
        const [label, content] = value.split("@");
        
        modalContent.innerHTML += `<p><span class="font-bold">${label}：</span><span>${content}</span></p>`;
    }
}


/**
 * Toggles the visibility of table columns based on checkbox state.
 * @param {HTMLInputElement} checkbox - The checkbox element.
 * @param {string} className - The class of the columns to toggle.
 */
function toggleColumnVisibility(checkbox, className) {
    const elements = document.querySelectorAll(`.${className}`);
    elements.forEach(element => {
        if (checkbox.checked) {
            element.classList.remove('hidden'); 
        } else {
            element.classList.add('hidden'); 
        }
    });
}


async function checkHellowork(button) {
    // Extract data attributes from the clicked element
    const customerId = button.getAttribute('data-customer-id');
    const hwBusinessNumber = button.getAttribute('data-hw-business-number');
    const corporateNumber = button.getAttribute('data-corporate-number');

    const params = new URLSearchParams({
        customer_id: customerId,
        corporate_number: corporateNumber,
    });

    const url = `/python-app/check-hellowork2?${params.toString()}`;
    
    // Show loading state
    modalContent.innerHTML = `<p>データを取得中です...</p>`;

    try {
        const response = await fetch(url);

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const json = await response.json();

        // Build modal content
        let content = `<p><span class="font-bold">現在求人件数：</span><span>${json.data["number_of_job_openings"]}</span></p>`;
        
        const jobTypeInfoTemplate = (jobType, targetContent) => {
            if (json.errors[jobType["key"]].length === 0) {
           
                detail_url = "";
                if (json.data["job_type"][jobType["key"]]["detail_url"] !== "") {
                    detail_url = `<a 
                            href="${json.data["job_type"][jobType["key"]]["detail_url"]}"
                            action="_blank"
                            class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline"
                        >
                            （参照先）
                        </a>`
                } 

                targetContent += `<p><span class="font-bold">・うちの${jobType["value"]}件数：</span><span>${json.data["job_type"][jobType["key"]]["count"]}</span>${detail_url}</p>`;
                targetContent += `<p><span class="font-bold ml-6">給料レンジ：</span></p>`;
                targetContent += `<p><span class="font-bold ml-8">上レンジ：</span><span>${json.data["job_type"][jobType["key"]]["salary_range"]["higher_range"]}</span></p>`;
                targetContent += `<p><span class="font-bold ml-8">下レンジ：</span><span>${json.data["job_type"][jobType["key"]]["salary_range"]["lower_range"]}</span></p>`;
            } else {
                targetContent += `<p><span class="font-bold">・うちの${jobType["value"]}件数：</span><span>${json.data["job_type"][jobType["key"]]["count"]}</span></p>`;
            }
      

            return targetContent;
        }
        
        content = jobTypeInfoTemplate({key: "fulltime", value:"フルタイム"}, content);
        content = jobTypeInfoTemplate({key: "parttime", value:"パート"}, content);
        
        // Update modal content
        modalContent.innerHTML = content;

    } catch (error) {
        console.error('Error fetching data:', error);
        modalContent.innerHTML = `<p>データの取得中にエラーが発生しました。</p>`;
    }
}
</script>