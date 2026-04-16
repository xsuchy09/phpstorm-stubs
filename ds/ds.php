<?php

/**
 * PHP Data Structure stubs, a PECL extension
 * @version 2.0.0
 * @author Dominic Guhl <dominic.guhl@posteo.de>
 * @copyright © 2019 PHP Documentation Group
 * @license CC-BY 3.0, https://www.php.net/manual/en/cc.license.php
 */

namespace Ds;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use JsonSerializable;
use OutOfBoundsException;
use OutOfRangeException;
use Traversable;
use UnderflowException;

/**
 * Key is an interface which allows objects to be used as keys with custom
 * equality semantics.
 *
 * Replaces Ds\Hashable in DS 2.0.
 *
 * @package Ds
 */
interface Key
{
    /**
     * Determines whether another object is equal to the current instance.
     *
     * @param object $obj
     * @return bool
     */
    public function equals($obj): bool;

    /**
     * Returns a scalar value to be used as the hash value of the object.
     *
     * @return mixed
     */
    public function hash();
}

/**
 * A pair is used by Ds\Map to pair keys with values.
 *
 * DS 2.0 release notes state that Ds\Pair is now a readonly class.
 *
 * @package Ds
 * @template-covariant TKey
 * @template-covariant TValue
 */
readonly final class Pair implements JsonSerializable
{
    /**
     * @var TKey
     */
    public mixed $key;

    /**
     * @var TValue
     */
    public mixed $value;

    /**
     * @param TKey $key
     * @param TValue $value
     */
    public function __construct($key = null, $value = null) {}

    public function clear(): void {}

    /**
     * @return Pair<TKey, TValue>
     */
    public function copy(): Pair {}

    public function isEmpty(): bool {}

    /**
     * @return array{key: TKey, value: TValue}
     */
    public function toArray(): array {}

    public function jsonSerialize(): mixed {}
}

/**
 * A Seq is an ordered sequence of values.
 *
 * Replaces Vector and Deque in DS 2.0.
 *
 * @package Ds
 * @template TValue
 * @implements IteratorAggregate<int, TValue>
 * @implements ArrayAccess<int, TValue>
 */
final class Seq implements Countable, IteratorAggregate, ArrayAccess, JsonSerializable
{
    /**
     * Creates a new instance, using either a traversable object or an array for
     * the initial values.
     *
     * @param iterable<TValue> $values
     */
    public function __construct(iterable $values = []) {}

    public function allocate(int $capacity): void {}

    /**
     * @param callable(TValue): TValue $callback
     */
    public function apply(callable $callback): void {}

    public function capacity(): int {}

    public function clear(): void {}

    /**
     * @param TValue ...$values
     */
    public function contains(...$values): bool {}

    /**
     * @return Seq<TValue>
     */
    public function copy(): Seq {}

    /**
     * @param null|callable(TValue): bool $callback
     * @return Seq<TValue>
     */
    public function filter(?callable $callback = null): Seq {}

    /**
     * @param TValue $value
     * @return int|false
     */
    public function find($value) {}

    /**
     * @return TValue
     * @throws UnderflowException
     */
    public function first() {}

    /**
     * @param int $index
     * @return TValue
     * @throws OutOfRangeException
     */
    public function get(int $index) {}

    /**
     * @return Traversable<int, TValue>
     */
    public function getIterator(): Traversable {}

    /**
     * @param int $index
     * @param TValue ...$values
     * @throws OutOfRangeException
     */
    public function insert(int $index, ...$values): void {}

    public function isEmpty(): bool {}

    public function join(string $glue = ''): string {}

    /**
     * @return TValue
     * @throws UnderflowException
     */
    public function last() {}

    /**
     * @template TNewValue
     * @param callable(TValue): TNewValue $callback
     * @return Seq<TNewValue>
     */
    public function map(callable $callback): Seq {}

    /**
     * @template TValue2
     * @param iterable<TValue2> $values
     * @return Seq<TValue|TValue2>
     */
    public function merge($values): Seq {}

    /**
     * @return TValue
     * @throws UnderflowException
     */
    public function pop() {}

    /**
     * @param TValue ...$values
     */
    public function push(...$values): void {}

    /**
     * @template TCarry
     * @param callable(TCarry, TValue): TCarry $callback
     * @param TCarry $initial
     * @return TCarry
     */
    public function reduce(callable $callback, $initial = null) {}

    /**
     * @param int $index
     * @return TValue
     */
    public function remove(int $index) {}

    public function reverse(): void {}

    /**
     * @return Seq<TValue>
     */
    public function reversed(): Seq {}

    public function rotate(int $rotations): void {}

    /**
     * @param int $index
     * @param TValue $value
     * @throws OutOfRangeException
     */
    public function set(int $index, $value): void {}

    /**
     * @return TValue
     * @throws UnderflowException
     */
    public function shift() {}

    /**
     * @param int $index
     * @param int|null $length
     * @return Seq<TValue>
     */
    public function slice(int $index, ?int $length = null): Seq {}

    /**
     * @param (callable(TValue, TValue): int)|null $comparator
     */
    public function sort(?callable $comparator = null): void {}

    /**
     * @param (callable(TValue, TValue): int)|null $comparator
     * @return Seq<TValue>
     */
    public function sorted(?callable $comparator = null): Seq {}

    public function sum(): float|int {}

    /**
     * @return list<TValue>
     */
    public function toArray(): array {}

    /**
     * @param TValue ...$values
     */
    public function unshift(...$values): void {}

    public function count(): int {}

    public function jsonSerialize(): mixed {}

    /**
     * @param int $offset
     */
    public function offsetExists(mixed $offset): bool {}

    /**
     * @param int $offset
     * @return TValue
     */
    public function offsetGet(mixed $offset) {}

    /**
     * @param int|null $offset
     * @param TValue $value
     */
    public function offsetSet(mixed $offset, mixed $value): void {}

    /**
     * @param int $offset
     */
    public function offsetUnset(mixed $offset): void {}
}

/**
 * A Map is a sequential collection of key-value pairs.
 *
 * @package Ds
 * @template TKey
 * @template TValue
 * @implements IteratorAggregate<TKey, TValue>
 * @implements ArrayAccess<TKey, TValue>
 */
final class Map implements Countable, IteratorAggregate, ArrayAccess, JsonSerializable
{
    /**
     * @param iterable<TKey, TValue> $values
     */
    public function __construct(iterable $values = []) {}

    public function allocate(int $capacity): void {}

    /**
     * @param callable(TKey, TValue): TValue $callback
     */
    public function apply(callable $callback): void {}

    public function capacity(): int {}

    public function clear(): void {}

    /**
     * @return Map<TKey, TValue>
     */
    public function copy(): Map {}

    public function count(): int {}

    /**
     * @template TValue2
     * @param Map<TKey, TValue2> $map
     * @return Map<TKey, TValue>
     */
    public function diff(Map $map): Map {}

    /**
     * @param null|callable(TKey, TValue): bool $callback
     * @return Map<TKey, TValue>
     */
    public function filter(?callable $callback = null): Map {}

    /**
     * @return Pair<TKey, TValue>
     * @throws UnderflowException
     */
    public function first(): Pair {}

    /**
     * @template TDefault
     * @param TKey $key
     * @param TDefault $default
     * @return TValue|TDefault
     * @throws OutOfBoundsException
     */
    public function get($key, $default = null) {}

    /**
     * @return Traversable<TKey, TValue>
     */
    public function getIterator(): Traversable {}

    /**
     * @param TKey $key
     */
    public function hasKey($key): bool {}

    /**
     * @param TValue $value
     */
    public function hasValue($value): bool {}

    /**
     * @template TKey2
     * @template TValue2
     * @param Map<TKey2, TValue2> $map
     * @return Map<TKey&TKey2, TValue>
     */
    public function intersect(Map $map): Map {}

    public function isEmpty(): bool {}

    public function jsonSerialize(): mixed {}

    /**
     * DS 2.0: Map::keys() returns Ds\Set.
     *
     * @return Set<TKey>
     */
    public function keys(): Set {}

    /**
     * @param (callable(TKey, TKey): int)|null $comparator
     */
    public function ksort(?callable $comparator = null): void {}

    /**
     * @param (callable(TKey, TKey): int)|null $comparator
     * @return Map<TKey, TValue>
     */
    public function ksorted(?callable $comparator = null): Map {}

    /**
     * @return Pair<TKey, TValue>
     * @throws UnderflowException
     */
    public function last(): Pair {}

    /**
     * @template TNewValue
     * @param callable(TKey, TValue): TNewValue $callback
     * @return Map<TKey, TNewValue>
     */
    public function map(callable $callback): Map {}

    /**
     * @template TKey2
     * @template TValue2
     * @param iterable<TKey2, TValue2> $values
     * @return Map<TKey|TKey2, TValue|TValue2>
     */
    public function merge($values): Map {}

    /**
     * DS 2.0: Map::pairs() returns Ds\Seq.
     *
     * @return Seq<Pair<TKey, TValue>>
     */
    public function pairs(): Seq {}

    /**
     * @param TKey $key
     * @param TValue $value
     */
    public function put($key, $value): void {}

    /**
     * @param iterable<TKey, TValue> $pairs
     */
    public function putAll($pairs): void {}

    /**
     * @template TCarry
     * @param callable(TCarry, TKey, TValue): TCarry $callback
     * @param TCarry $initial
     * @return TCarry
     */
    public function reduce(callable $callback, $initial = null) {}

    /**
     * @template TDefault
     * @param TKey $key
     * @param TDefault $default
     * @return TValue|TDefault
     * @throws OutOfBoundsException
     */
    public function remove($key, $default = null) {}

    public function reverse(): void {}

    /**
     * @return Map<TKey, TValue>
     */
    public function reversed(): Map {}

    /**
     * @param int $position
     * @return Pair<TKey, TValue>
     * @throws OutOfRangeException
     */
    public function skip(int $position): Pair {}

    /**
     * @param int $index
     * @param int|null $length
     * @return Map<TKey, TValue>
     */
    public function slice(int $index, ?int $length = null): Map {}

    /**
     * @param (callable(TValue, TValue): int)|null $comparator
     */
    public function sort(?callable $comparator = null): void {}

    /**
     * @param (callable(TValue, TValue): int)|null $comparator
     * @return Map<TKey, TValue>
     */
    public function sorted(?callable $comparator = null): Map {}

    public function sum(): float|int {}

    /**
     * @return array<TKey, TValue>
     */
    public function toArray(): array {}

    /**
     * @template TKey2
     * @template TValue2
     * @param Map<TKey2, TValue2> $map
     * @return Map<TKey|TKey2, TValue|TValue2>
     */
    public function union(Map $map): Map {}

    /**
     * DS 2.0: Map::values() returns Ds\Seq.
     *
     * @return Seq<TValue>
     */
    public function values(): Seq {}

    /**
     * @template TKey2
     * @template TValue2
     * @param Map<TKey2, TValue2> $map
     * @return Map<TKey|TKey2, TValue|TValue2>
     */
    public function xor(Map $map): Map {}

    /**
     * @param TKey $offset
     */
    public function offsetExists(mixed $offset): bool {}

    /**
     * @param TKey $offset
     * @return TValue
     */
    public function offsetGet(mixed $offset) {}

    /**
     * @param TKey $offset
     * @param TValue $value
     */
    public function offsetSet(mixed $offset, mixed $value): void {}

    /**
     * @param TKey $offset
     */
    public function offsetUnset(mixed $offset): void {}
}

/**
 * A Set is a sequential collection of unique values.
 *
 * @package Ds
 * @template TValue
 * @implements IteratorAggregate<int, TValue>
 * @implements ArrayAccess<int, TValue>
 */
final class Set implements Countable, IteratorAggregate, ArrayAccess, JsonSerializable
{
    /**
     * @param iterable<TValue> $values
     */
    public function __construct(iterable $values = []) {}

    /**
     * @param TValue ...$values
     */
    public function add(...$values): void {}

    public function allocate(int $capacity): void {}

    public function capacity(): int {}

    public function clear(): void {}

    /**
     * @param TValue ...$values
     */
    public function contains(...$values): bool {}

    public function count(): int {}

    /**
     * @return Set<TValue>
     */
    public function copy(): Set {}

    /**
     * @template TValue2
     * @param Set<TValue2> $set
     * @return Set<TValue>
     */
    public function diff(Set $set): Set {}

    /**
     * @param null|callable(TValue): bool $callback
     * @return Set<TValue>
     */
    public function filter(?callable $callback = null): Set {}

    /**
     * @return TValue
     */
    public function first() {}

    /**
     * @param int $index
     * @return TValue
     */
    public function get(int $index) {}

    /**
     * @return Traversable<int, TValue>
     */
    public function getIterator(): Traversable {}

    /**
     * @template TValue2
     * @param Set<TValue2> $set
     * @return Set<TValue&TValue2>
     */
    public function intersect(Set $set): Set {}

    public function isEmpty(): bool {}

    public function join(string $glue = ''): string {}

    public function jsonSerialize(): mixed {}

    /**
     * @return TValue
     * @throws UnderflowException
     */
    public function last() {}

    /**
     * @template TNewValue
     * @param callable(TValue): TNewValue $callback
     * @return Set<TNewValue>
     */
    public function map(callable $callback): Set {}

    /**
     * @template TValue2
     * @param iterable<TValue2> $values
     * @return Set<TValue|TValue2>
     */
    public function merge($values): Set {}

    /**
     * @template TCarry
     * @param callable(TCarry, TValue): TCarry $callback
     * @param TCarry $initial
     * @return TCarry
     */
    public function reduce(callable $callback, $initial = null) {}

    /**
     * @param TValue ...$values
     */
    public function remove(...$values): void {}

    public function reverse(): void {}

    /**
     * @return Set<TValue>
     */
    public function reversed(): Set {}

    /**
     * @param int $index
     * @param int|null $length
     * @return Set<TValue>
     */
    public function slice(int $index, ?int $length = null): Set {}

    /**
     * @param (callable(TValue, TValue): int)|null $comparator
     */
    public function sort(?callable $comparator = null): void {}

    /**
     * @param (callable(TValue, TValue): int)|null $comparator
     * @return Set<TValue>
     */
    public function sorted(?callable $comparator = null): Set {}

    public function sum(): float|int {}

    /**
     * @return list<TValue>
     */
    public function toArray(): array {}

    /**
     * @template TValue2
     * @param Set<TValue2> $set
     * @return Set<TValue|TValue2>
     */
    public function union(Set $set): Set {}

    /**
     * @template TValue2
     * @param Set<TValue2> $set
     * @return Set<TValue|TValue2>
     */
    public function xor(Set $set): Set {}

    /**
     * @param int $offset
     */
    public function offsetExists(mixed $offset): bool {}

    /**
     * @param int $offset
     * @return TValue
     */
    public function offsetGet(mixed $offset) {}

    /**
     * @param int|null $offset
     * @param TValue $value
     */
    public function offsetSet(mixed $offset, mixed $value): void {}

    /**
     * @param int $offset
     */
    public function offsetUnset(mixed $offset): void {}
}

/**
 * A Heap is a configurable heap, max-heap by default.
 *
 * Replaces PriorityQueue in DS 2.0.
 *
 * @package Ds
 * @template TValue
 * @implements IteratorAggregate<int, TValue>
 */
final class Heap implements Countable, IteratorAggregate, JsonSerializable
{
    public const MIN_CAPACITY = 8;

    /**
     * @param null|callable(TValue, TValue): int $comparator
     */
    public function __construct(?callable $comparator = null) {}

    public function allocate(int $capacity): void {}

    public function capacity(): int {}

    public function clear(): void {}

    /**
     * @return Heap<TValue>
     */
    public function copy(): Heap {}

    public function count(): int {}

    /**
     * @return Traversable<int, TValue>
     */
    public function getIterator(): Traversable {}

    public function isEmpty(): bool {}

    public function jsonSerialize(): mixed {}

    /**
     * @return TValue
     * @throws UnderflowException
     */
    public function peek() {}

    /**
     * @return TValue
     * @throws UnderflowException
     */
    public function pop() {}

    /**
     * @param TValue ...$values
     */
    public function push(...$values): void {}

    /**
     * @return list<TValue>
     */
    public function toArray(): array {}
}

/**
 * Functional constructors added in DS 2.0.
 *
 * @template TValue
 * @param iterable<TValue> $values
 * @return Seq<TValue>
 */
function seq(iterable $values = []): Seq {}

/**
 * @template TKey
 * @template TValue
 * @param iterable<TKey, TValue> $values
 * @return Map<TKey, TValue>
 */
function map(iterable $values = []): Map {}

/**
 * @template TValue
 * @param iterable<TValue> $values
 * @return Set<TValue>
 */
function set(iterable $values = []): Set {}

/**
 * @template TValue
 * @param null|callable(TValue, TValue): int $comparator
 * @return Heap<TValue>
 */
function heap(?callable $comparator = null): Heap {}