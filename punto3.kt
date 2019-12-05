fun main() {
    print("This script return the index of the longest-run, please enter your word: ")
    val stringInput = readLine()
    println("Index: "+findIndex(stringInput!!))


}

fun findIndex(word:String): Int {
    val n = word.length
    var max_count = 0
    var cur_count = 1
    var index = 0
    for (character in 0 until n)
    {   // there are two options, the next character is the same or not
        if (character < n - 1 && word[character] == word[character + 1]) //is the same so the current counter increase
            cur_count++
        else
        {   // is not, we will compare the current counter with the max counter in order to know if the previous stream of characters are the longest
            if (cur_count > max_count)
            {
                max_count = cur_count
                index = character - (max_count -1)
            }
            cur_count = 1

        }
    }
    return index
}