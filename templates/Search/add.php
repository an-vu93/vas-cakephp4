<div class="mx-auto bg-white shadow-md rounded-lg overflow-hidden mb-10">
        <div class="p-6">
            <h2 class="text-2xl font-semibold mb-6">顧客検索</h2>
            <form>
                <table class="w-full">
                    <tr class="flex">
                        <td class="flex w-1/3 border-none p-0">
                            <label class="font-medium bg-blue-500 text-white border border-blue-500 w-1/4">顧客名又はID</label>
                            <input type="text" class="shadow w-3/4 bg-gray-50 text-gray-900 border border-gray-300 focus:ring-primary-500 focus:border-primary-500 p-2.5">
                        </td>
                        <td class="flex w-1/3 border-none p-0">
                            <label class="font-medium bg-blue-500 text-white w-1/4">商品種別</label>
                            <select class="shadow w-3/4 bg-gray-50 text-gray-900 border border-gray-300 focus:ring-primary-500 focus:border-primary-500 p-2.5">
                                <option value="1">1</option>
                                <option value="1">1</option>
                                <option value="1">1</option>
                                <option value="1">1</option>
                            </select>
                        </td>
                        <td class="flex w-1/3 border-none p-0">
                            <label class="font-medium bg-blue-500 text-white w-1/4">ID検索</label>
                            <input type="text" class="shadow w-3/4 bg-gray-50 text-gray-900 border border-gray-300 focus:ring-primary-500 focus:border-primary-500 p-2.5">
                        </td>
                    </tr>
                    <tr class="flex">
                        <td class="flex w-1/3 border-none p-0">
                            <label class="font-medium bg-blue-500 text-white w-1/4">顧客名</label>
                            <input type="text" class="shadow w-3/4 bg-gray-50 text-gray-900 border border-gray-300 focus:ring-primary-500 focus:border-primary-500 p-2.5">
                        </td>
                        <td class="flex w-1/3 border-none p-0">
                            <label class="font-medium bg-blue-500 text-white w-1/4">商品種別</label>
                            <select class="shadow w-3/4 bg-gray-50 text-gray-900 border border-gray-300 focus:ring-primary-500 focus:border-primary-500 p-2.5">
                                
                            </select>
                        </td>
                        <td class="flex w-1/3 border-none p-0">
                            <label class="font-medium bg-blue-500 text-white w-1/4">ID検索</label>
                            <input type="text" class="shadow w-3/4 bg-gray-50 text-gray-900 border border-gray-300 focus:ring-primary-500 focus:border-primary-500 p-2.5">
                        </td>
                    </tr>
                    


                    <!-- <tr>
                        <td class="p-2">
                            <label class="block font-medium text-gray-700">支社</label>
                            <select class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option>- 選択(入力→検索) -</option>
                            </select>
                        </td>
                        <td class="p-2">
                            <label class="block font-medium text-gray-700">エリア</label>
                            <select class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option>- 選択(入力→検索) -</option>
                            </select>
                        </td>
                        <td class="p-2">
                            <input type="text" placeholder="商品ID" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </td>
                    </tr>
                    <tr>
                        <td class="p-2">
                            <label class="block font-medium text-gray-700">オプション</label>
                            <select class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option>- 選択(入力→検索) -</option>
                            </select>
                        </td>
                        <td class="p-2">
                            <label class="block font-medium text-gray-700">使用サーバ</label>
                            <select class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option>- 選択(入力→検索) -</option>
                            </select>
                        </td>
                        <td class="p-2">
                            <label class="block font-medium text-gray-700">担当営業</label>
                            <select class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option>- 選択(入力→検索) -</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-2">
                            <label class="block font-medium text-gray-700">契約状態</label>
                            <div class="mt-2 flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox" checked>
                                    <span class="ml-2">契約中</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox">
                                    <span class="ml-2">キャンセル</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox">
                                    <span class="ml-2">解約</span>
                                </label>
                            </div>
                        </td>
                        <td class="p-2">
                            <label class="block font-medium text-gray-700">移行状態</label>
                            <div class="mt-2 flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio" name="migration_status" value="all">
                                    <span class="ml-2">すべて</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio" name="migration_status" value="completed">
                                    <span class="ml-2">移行済のみ</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio" name="migration_status" value="not_completed" checked>
                                    <span class="ml-2">移行済は含まない</span>
                                </label>
                            </div>
                        </td>
                        <td class="p-2">
                            <label class="block font-medium text-gray-700">都道府県</label>
                            <select class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option>- 選択(入力→検索) -</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-2">
                            <label class="block font-medium text-gray-700">シリーズ区分</label>
                            <div class="mt-2 flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox">
                                    <span class="ml-2">CX</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox">
                                    <span class="ml-2">DX</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox">
                                    <span class="ml-2">HR</span>
                                </label>
                            </div>
                        </td>
                        <td></td>
                        <td class="p-2">
                            <label class="block font-medium text-gray-700">利用目的</label>
                            <div class="mt-2 flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio" name="usage_purpose" value="all" checked>
                                    <span class="ml-2">すべて</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio" name="usage_purpose" value="normal">
                                    <span class="ml-2">通常</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio" name="usage_purpose" value="self_use">
                                    <span class="ml-2">自社用</span>
                                </label>
                            </div>
                        </td>
                    </tr> -->
                </table>
                
                <div class="mt-8 flex justify-center space-x-4">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        検索
                    </button>
                    <button type="button" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
                        検索条件クリア
                    </button>
                    <button type="button" class="px-4 py-2 bg-teal-500 text-white rounded-md hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-opacity-50">
                        CSV出力
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="mx-auto bg-white shadow-md rounded-lg overflow-hidden">
    <div class="p-6">
        <table id="dynamicTable" class="table-auto w-full border border-white my-5">
            <thead class="bg-primary-500 text-white">
                
            </thead>
            <tbody class="bg-primary-50">
                
                <tr>
                    <td>
                        大塚国際美術館
                    </td>
                    <td>
                        徳島県
                    </td>
                    <td>
                        四国　PG
                    </td>
                    <td>
                        2015年9月9日
                    </td>
                    <td>
                        02024年7月9日
                    </td>
                    <td>
                        15
                    </td>
                    <td>
                        2
                    </td>
                    <td>
                        2
                    </td>
                    <td>
                        413
                    </td>
                    <td>
                        3.53
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

