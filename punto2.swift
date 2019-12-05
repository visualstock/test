func isAnagram(firstWord: String, secondWord: String) -> Bool {
    print("checking 🤔 ... ")
    return firstWord.sorted() == secondWord.sorted()

}


print("This script allow to check if two words are anagrams  ⌨️")
print("Please write the first word 🔤 ", terminator: ":")
let firstWord = readLine()
print("Now the second word 🔤 ", terminator: ":")
let secondWord = readLine()
print("Is an Anagram? \(isAnagram(firstWord: firstWord!, secondWord: secondWord!))")