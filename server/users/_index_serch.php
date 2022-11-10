        <div class="serch wrapper">
            <form class="serch_category" action="" method="post">
                <label for="serch_category_select"><div>カデコリ検索</div>
                    <select name="serch_category" id="serch_category_select">
                        <option value="jimu">事務系</option>
                        <option value="eigyo">営業系</option>
                        <option value="nikutai">肉体労働系</option>
                    </select>
                </label>
                <label class="serch-btn" for="serch-category-submit">
                    <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                    <input id="serch-category-submit" type="submit" value="">
                </label>
            </form>

            <form class="serch_word" action="" method="post">
                <label for="serch_word_input"><div>キーワード検索</div>
                    <input type="text" id="serch_word_input" name="serch_word" value="<?php print h($serch_word) ?>">
                </label>
                <label class="serch-btn" for="serch-word-submit">
                    <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                    <input id="serch-word-submit" type="submit" value="">
                </label>
            </form>
        </div>
