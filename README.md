# either

```
$result = Either::right(5);

$result->flatMap(function($value) {
if ($value < 0) {
return Either::left("Value must be greater than zero.");
} else {
return Either::right($value);
}
});

if ($result->isLeft()) {
echo $result->getOrElse(function($error) { return $error; });
} else {
echo $result->get();
}
```
