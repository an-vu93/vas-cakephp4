<?php 
$this->extend('/element/container');

$this->assign('title', 'ツール追加');
?>

<div class="p-6 bg-white border border-gray-200 rounded-lg shadow">
    <form class="mx-auto" action>
        <div class="flex mb-5">
            <label for="name" class="mb-2 text-lg font-medium text-gray-900">解析名</label>
            <input type="name" id="name" class="shadow bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-1/2 p-2.5 ml-5" required />
        </div>
        <div class="flex mb-5">
            <label for="description" class="mb-2 text-lg font-medium text-gray-900">説明文</label>
            <textarea type="description" id="description" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-10/12 p-2.5 ml-5" rows="4"></textarea>
        </div>
        
        <table class="table-auto w-full border border-white mt-5 mb-5">
            <thead class="bg-primary-500 text-white">
                <tr>
                    <th scope="col" class="px-4 py-2 border border-white">
                        指標
                    </th>
                    <th scope="col" class="px-4 py-2 border border-white">
                        重み
                    </th>
                    <th scope="col" class="px-4 py-2 border border-white">
                        操作
                    </th>
                </tr>
            </thead>
            <tbody class="bg-primary-50">
                <?php for($i = 0; $i < 5; $i++): ?>
                <tr class="border">
                    <th scope="row" class="px-4 py-2 border border-white">
                        <select name="" id="" class="w-full p-2 border border-primary-300 bg-white rounded">
                            <option value="1">受注日から経過日数</option>
                            <option value="2">受注日から経過日数</option>
                            <option value="3">受注日から経過日数</option>
                            <option value="4">受注日から経過日数</option>
                            <option value="5">受注日から経過日数</option>
                        </select>
                    </th>
                    <td class="px-4 py-2 text-center border border-white">
                        <select name="" id="" class="w-full p-2 border border-primary-300 bg-white rounded">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </td>
                    <td class="px-4 py-2 text-center border border-white">
                        <button class="w-2/5 px-2 py-2 bg-white border border-primary-700 text-primary-500 rounded hover:bg-primary-500 hover:text-white">追加</button>
                        <button class="w-2/5 px-2 py-2 bg-white border border-primary-700 text-primary-500 rounded hover:bg-primary-500 hover:text-white">削除</button>
                    </td>
                </tr>
                <?php endfor; ?>
            </tbody>
        </table>

        <button type="submit" class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-10 py-3 text-center">保存</button>
</form>
 

        
</div>